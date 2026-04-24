<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Payment;
use App\Models\User;
use App\Models\Visitor;
use App\Services\GeoIp\MaxMindGeoLiteService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __construct(
        protected MaxMindGeoLiteService $geoIpService
    ) {
    }

    public function index(): View
    {
        $stats = [
            'courses' => Course::count(),
            'clients' => User::where('role', 'student')->count(),
            'instructors' => Instructor::count(),
            'payments' => Payment::where('status', 'successful')->count(),
            'revenue' => Payment::where('status', 'successful')->sum('amount'),
            'visitors_total' => Visitor::count(),
            'visitors_month' => Visitor::whereBetween('last_visited_at', [now()->startOfMonth(), now()->endOfMonth()])->count(),
            'unique_users_total' => Visitor::whereNotNull('ip_address')
                ->distinct('ip_address')
                ->count('ip_address'),
            'unique_users_month' => Visitor::whereNotNull('ip_address')
                ->whereBetween('last_visited_at', [now()->startOfMonth(), now()->endOfMonth()])
                ->distinct('ip_address')
                ->count('ip_address'),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function reports(): View
    {
        $reports = [
            'visitors' => $this->buildVisitorReportData(),
            'unique_users' => $this->buildUniqueUserReportData(),
        ];

        $geoLocationConfigured = $this->geoIpService->isAvailable();
        $geoLocationDatabasePath = $this->geoIpService->databasePath();

        return view('admin.reports', compact('reports', 'geoLocationConfigured', 'geoLocationDatabasePath'));
    }

    protected function buildVisitorReportData(): array
    {
        $monthKeys = Visitor::query()
            ->whereNotNull('first_visited_at')
            ->selectRaw("DATE_FORMAT(first_visited_at, '%Y-%m') as month_key")
            ->groupBy('month_key')
            ->orderByDesc('month_key')
            ->pluck('month_key');

        $yearKeys = Visitor::query()
            ->whereNotNull('first_visited_at')
            ->selectRaw('YEAR(first_visited_at) as year_key')
            ->groupBy('year_key')
            ->orderByDesc('year_key')
            ->pluck('year_key')
            ->map(fn ($year) => (string) $year);

        $dailyRows = Visitor::query()
            ->whereNotNull('first_visited_at')
            ->selectRaw("DATE_FORMAT(first_visited_at, '%Y-%m') as month_key")
            ->selectRaw('DAY(first_visited_at) as bucket')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('month_key', 'bucket')
            ->orderBy('month_key')
            ->orderBy('bucket')
            ->get();

        $monthlyRows = Visitor::query()
            ->whereNotNull('first_visited_at')
            ->selectRaw('YEAR(first_visited_at) as year_key')
            ->selectRaw('MONTH(first_visited_at) as bucket')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('year_key', 'bucket')
            ->orderBy('year_key')
            ->orderBy('bucket')
            ->get();

        $countryRows = Visitor::query()
            ->selectRaw('country_name as bucket')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('bucket')
            ->orderByDesc('total')
            ->orderBy('bucket')
            ->get();

        $regionRows = Visitor::query()
            ->selectRaw('region_name as bucket')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('bucket')
            ->orderByDesc('total')
            ->orderBy('bucket')
            ->get();

        return $this->formatReportPayload(
            title: __('admin.reports_visitors_title'),
            description: __('admin.reports_visitors_description'),
            monthKeys: $monthKeys,
            yearKeys: $yearKeys,
            dailyRows: $dailyRows,
            monthlyRows: $monthlyRows,
            countryRows: $countryRows,
            regionRows: $regionRows
        );
    }

    protected function buildUniqueUserReportData(): array
    {
        $monthKeys = Visitor::query()
            ->whereNotNull('first_visited_at')
            ->whereNotNull('ip_address')
            ->selectRaw("DATE_FORMAT(first_visited_at, '%Y-%m') as month_key")
            ->groupBy('month_key')
            ->orderByDesc('month_key')
            ->pluck('month_key');

        $yearKeys = Visitor::query()
            ->whereNotNull('first_visited_at')
            ->whereNotNull('ip_address')
            ->selectRaw('YEAR(first_visited_at) as year_key')
            ->groupBy('year_key')
            ->orderByDesc('year_key')
            ->pluck('year_key')
            ->map(fn ($year) => (string) $year);

        $dailyRows = Visitor::query()
            ->whereNotNull('first_visited_at')
            ->whereNotNull('ip_address')
            ->selectRaw("DATE_FORMAT(first_visited_at, '%Y-%m') as month_key")
            ->selectRaw('DAY(first_visited_at) as bucket')
            ->selectRaw('COUNT(DISTINCT ip_address) as total')
            ->groupBy('month_key', 'bucket')
            ->orderBy('month_key')
            ->orderBy('bucket')
            ->get();

        $monthlyRows = Visitor::query()
            ->whereNotNull('first_visited_at')
            ->whereNotNull('ip_address')
            ->selectRaw('YEAR(first_visited_at) as year_key')
            ->selectRaw('MONTH(first_visited_at) as bucket')
            ->selectRaw('COUNT(DISTINCT ip_address) as total')
            ->groupBy('year_key', 'bucket')
            ->orderBy('year_key')
            ->orderBy('bucket')
            ->get();

        $countryRows = Visitor::query()
            ->whereNotNull('ip_address')
            ->selectRaw('country_name as bucket')
            ->selectRaw('COUNT(DISTINCT ip_address) as total')
            ->groupBy('bucket')
            ->orderByDesc('total')
            ->orderBy('bucket')
            ->get();

        $regionRows = Visitor::query()
            ->whereNotNull('ip_address')
            ->selectRaw('region_name as bucket')
            ->selectRaw('COUNT(DISTINCT ip_address) as total')
            ->groupBy('bucket')
            ->orderByDesc('total')
            ->orderBy('bucket')
            ->get();

        return $this->formatReportPayload(
            title: __('admin.reports_unique_users_title'),
            description: __('admin.reports_unique_users_description'),
            monthKeys: $monthKeys,
            yearKeys: $yearKeys,
            dailyRows: $dailyRows,
            monthlyRows: $monthlyRows,
            countryRows: $countryRows,
            regionRows: $regionRows
        );
    }

    protected function formatReportPayload(
        string $title,
        string $description,
        Collection $monthKeys,
        Collection $yearKeys,
        Collection $dailyRows,
        Collection $monthlyRows,
        Collection $countryRows,
        Collection $regionRows
    ): array {
        $monthOptions = $monthKeys
            ->map(fn (string $monthKey) => [
                'value' => $monthKey,
                'label' => Carbon::createFromFormat('Y-m', $monthKey)
                    ->locale(app()->getLocale())
                    ->translatedFormat('F Y'),
            ])
            ->values();

        $yearOptions = $yearKeys
            ->map(fn (string $yearKey) => [
                'value' => $yearKey,
                'label' => $yearKey,
            ])
            ->values();

        $defaultMonth = $this->resolveDefaultMonth($monthOptions->pluck('value'));
        $defaultYear = $this->resolveDefaultYear($yearOptions->pluck('value'));

        $monthsByYear = collect(range(1, 12))
            ->map(fn (int $month) => Carbon::create()->month($month)->locale(app()->getLocale())->translatedFormat('M'))
            ->values()
            ->all();

        return [
            'title' => $title,
            'description' => $description,
            'monthOptions' => $monthOptions->all(),
            'yearOptions' => $yearOptions->all(),
            'defaultMonth' => $defaultMonth,
            'defaultYear' => $defaultYear,
            'monthSeries' => $this->buildMonthSeries($monthKeys, $dailyRows),
            'yearSeries' => $this->buildYearSeries($yearKeys, $monthlyRows, $monthsByYear),
            'countrySeries' => $this->buildBreakdownSeries($countryRows),
            'regionSeries' => $this->buildBreakdownSeries($regionRows),
        ];
    }

    protected function buildMonthSeries(Collection $monthKeys, Collection $rows): array
    {
        return $monthKeys
            ->mapWithKeys(function (string $monthKey) use ($rows) {
                $monthDate = Carbon::createFromFormat('Y-m', $monthKey);
                $daysInMonth = $monthDate->daysInMonth;
                $indexedRows = $rows
                    ->where('month_key', $monthKey)
                    ->keyBy(fn ($row) => (int) $row->bucket);

                $points = collect(range(1, $daysInMonth))
                    ->map(function (int $day) use ($indexedRows) {
                        return [
                            'label' => (string) $day,
                            'value' => (int) data_get($indexedRows->get($day), 'total', 0),
                        ];
                    })
                    ->all();

                return [$monthKey => $this->makeSeriesPayload($points)];
            })
            ->all();
    }

    protected function buildYearSeries(Collection $yearKeys, Collection $rows, array $monthLabels): array
    {
        return $yearKeys
            ->mapWithKeys(function (string $yearKey) use ($rows, $monthLabels) {
                $indexedRows = $rows
                    ->where('year_key', (int) $yearKey)
                    ->keyBy(fn ($row) => (int) $row->bucket);

                $points = collect(range(1, 12))
                    ->map(function (int $month) use ($indexedRows, $monthLabels) {
                        return [
                            'label' => $monthLabels[$month - 1],
                            'value' => (int) data_get($indexedRows->get($month), 'total', 0),
                        ];
                    })
                    ->all();

                return [$yearKey => $this->makeSeriesPayload($points)];
            })
            ->all();
    }

    protected function makeSeriesPayload(array $points): array
    {
        $max = max(1, collect($points)->max('value'));

        return [
            'points' => $points,
            'max' => $max,
            'total' => collect($points)->sum('value'),
        ];
    }

    protected function buildBreakdownSeries(Collection $rows): array
    {
        $points = $rows
            ->map(function ($row) {
                $label = trim((string) ($row->bucket ?? ''));

                return [
                    'label' => $label,
                    'value' => (int) $row->total,
                ];
            })
            ->filter(fn (array $point) => $point['label'] !== '' && $point['value'] > 0)
            ->values()
            ->all();

        return [
            'points' => $points,
            'total' => collect($points)->sum('value'),
        ];
    }

    protected function resolveDefaultMonth(Collection $monthValues): ?string
    {
        $currentMonth = now()->format('Y-m');

        if ($monthValues->contains($currentMonth)) {
            return $currentMonth;
        }

        return $monthValues->first();
    }

    protected function resolveDefaultYear(Collection $yearValues): ?string
    {
        $currentYear = (string) now()->year;

        if ($yearValues->contains($currentYear)) {
            return $currentYear;
        }

        return $yearValues->first();
    }
}
