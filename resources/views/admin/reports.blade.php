<x-admin-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="space-y-6">
                <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('admin.reports_title') }}</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.reports_description') }}</p>
                </div>

                @unless ($geoLocationConfigured)
                    <div class="rounded-3xl border border-amber-200 bg-amber-50 px-6 py-5 text-sm text-amber-900 shadow-sm dark:border-amber-300/30 dark:bg-amber-500/10 dark:text-amber-100">
                        <p class="font-semibold">{{ __('admin.reports_geo_notice_title') }}</p>
                        <p class="mt-1">{{ __('admin.reports_geo_notice_description') }}</p>
                        <p class="mt-2 font-mono text-xs">{{ $geoLocationDatabasePath }}</p>
                    </div>
                @endunless

                <div class="grid gap-6 xl:grid-cols-2">
                    @foreach ($reports as $metricKey => $report)
                        <div
                            x-data="reportCard(@js($report))"
                            class="overflow-hidden rounded-3xl bg-white p-4 shadow-sm sm:p-6 dark:bg-gray-400"
                        >
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                <div class="min-w-0">
                                    <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ $report['title'] }}</p>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ $report['description'] }}</p>
                                </div>
                                <div class="w-fit rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                                    @if ($metricKey === 'visitors')
                                        <x-heroicon-s-eye class="h-6 w-6 text-primary-700 dark:text-white" />
                                    @else
                                        <x-heroicon-s-computer-desktop class="h-6 w-6 text-primary-700 dark:text-white" />
                                    @endif
                                </div>
                            </div>

                            <div class="mt-6 grid grid-cols-2 gap-2 rounded-2xl bg-primary-50 p-1 sm:inline-flex sm:w-auto sm:flex-wrap dark:bg-stone/60">
                                <button
                                    type="button"
                                    @click="period = 'month'"
                                    :class="period === 'month' ? 'bg-white text-primary-700 shadow-sm dark:bg-gray-500 dark:text-white' : 'text-gray-600 dark:text-gray-200'"
                                    class="rounded-xl px-3 py-2 text-center text-sm font-medium transition sm:px-4"
                                >
                                    {{ __('admin.reports_period_month') }}
                                </button>
                                <button
                                    type="button"
                                    @click="period = 'year'"
                                    :class="period === 'year' ? 'bg-white text-primary-700 shadow-sm dark:bg-gray-500 dark:text-white' : 'text-gray-600 dark:text-gray-200'"
                                    class="rounded-xl px-3 py-2 text-center text-sm font-medium transition sm:px-4"
                                >
                                    {{ __('admin.reports_period_year') }}
                                </button>
                                <button
                                    type="button"
                                    @click="period = 'country'"
                                    :class="period === 'country' ? 'bg-white text-primary-700 shadow-sm dark:bg-gray-500 dark:text-white' : 'text-gray-600 dark:text-gray-200'"
                                    class="rounded-xl px-3 py-2 text-center text-sm font-medium transition sm:px-4"
                                >
                                    {{ __('admin.reports_period_country') }}
                                </button>
                                <button
                                    type="button"
                                    @click="period = 'region'"
                                    :class="period === 'region' ? 'bg-white text-primary-700 shadow-sm dark:bg-gray-500 dark:text-white' : 'text-gray-600 dark:text-gray-200'"
                                    class="rounded-xl px-3 py-2 text-center text-sm font-medium transition sm:px-4"
                                >
                                    {{ __('admin.reports_period_region') }}
                                </button>
                            </div>

                            <template x-if="hasData">
                                <div>
                                    <div class="mt-6" x-show="usesSelect">
                                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-white" x-text="period === 'month' ? @js(__('admin.reports_month_label')) : @js(__('admin.reports_year_label'))"></label>
                                        <select
                                            x-model="selectedKey"
                                            class="block w-full rounded-2xl border-0 bg-primary-50 px-4 py-3 text-sm text-gray-700 ring-1 ring-primary-200 focus:ring-primary-500 dark:bg-stone/60 dark:text-white dark:ring-stone"
                                        >
                                            <template x-for="option in currentOptions" :key="option.value">
                                                <option :value="option.value" x-text="option.label"></option>
                                            </template>
                                        </select>
                                    </div>

                                    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                                        <div class="min-w-0">
                                            <p class="text-sm text-gray-500 dark:text-gray-100" x-text="summaryLabel"></p>
                                            <p class="mt-1 text-2xl font-semibold text-gray-900 sm:text-3xl dark:text-white" x-text="formattedTotal"></p>
                                        </div>
                                        <p class="text-sm text-gray-500 sm:text-right dark:text-gray-100">
                                            {{ __('admin.reports_total_label') }}
                                        </p>
                                    </div>

                                    <div x-show="usesBarChart" class="mt-6 overflow-x-auto rounded-3xl bg-primary-50/70 p-3 sm:p-4 dark:bg-stone/40">
                                        <div class="min-w-full" :style="`width: ${chartWidth}px`">
                                            <div class="flex h-64 items-end gap-2 sm:h-72 sm:gap-3">
                                                <template x-for="point in currentSeries.points" :key="`${selectedKey}-${point.label}`">
                                                    <div class="flex min-w-[2.25rem] flex-1 flex-col items-center justify-end sm:min-w-[2.75rem]">
                                                        <span class="mb-2 text-xs font-semibold text-primary-700 dark:text-primary-100" x-text="point.value"></span>
                                                        <div class="flex h-48 w-full items-end rounded-t-2xl bg-primary-100/80 px-1 sm:h-56 dark:bg-stone/70">
                                                            <div
                                                                class="w-full rounded-t-2xl bg-primary-600 transition-all dark:bg-primary-200"
                                                                :style="`height: ${barHeight(point.value)}%`"
                                                            ></div>
                                                        </div>
                                                        <span class="mt-2 text-[11px] text-gray-500 sm:mt-3 sm:text-xs dark:text-gray-100" x-text="point.label"></span>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>

                                    <div x-show="usesPieChart" class="mt-6 rounded-3xl bg-primary-50/70 p-4 sm:p-5 dark:bg-stone/40">
                                        <div class="grid gap-5 lg:grid-cols-[220px,1fr] lg:items-start">
                                            <div class="mx-auto flex justify-center">
                                                <div class="relative h-40 w-40 rounded-full sm:h-52 sm:w-52" :style="pieStyle">
                                                    <div class="absolute inset-5 rounded-full bg-white sm:inset-7 dark:bg-gray-400"></div>
                                                    <div class="absolute inset-0 flex items-center justify-center">
                                                        <div class="text-center">
                                                            <p class="text-xs uppercase tracking-[0.2em] text-gray-500 dark:text-gray-100">{{ __('admin.reports_total_label') }}</p>
                                                            <p class="mt-1 text-xl font-semibold text-gray-900 sm:mt-2 sm:text-2xl dark:text-white" x-text="formattedTotal"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="max-h-80 space-y-3 overflow-y-auto pr-1">
                                                <template x-for="(point, index) in currentSeries.points" :key="`${period}-${point.label}`">
                                                    <div class="flex items-center justify-between gap-3 rounded-2xl bg-white/80 px-3 py-3 sm:px-4 dark:bg-stone/60">
                                                        <div class="flex min-w-0 items-center gap-3">
                                                            <span class="h-3.5 w-3.5 shrink-0 rounded-full" :style="`background-color: ${sliceColor(index)}`"></span>
                                                            <span class="truncate text-sm font-medium text-gray-700 dark:text-white" x-text="point.label"></span>
                                                        </div>
                                                        <div class="shrink-0 text-right">
                                                            <p class="text-sm font-semibold text-gray-900 dark:text-white" x-text="formatNumber(point.value)"></p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-100" x-text="formatPercent(point.value)"></p>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="!hasData">
                                <div class="mt-6 rounded-2xl bg-primary-50 px-4 py-8 text-sm text-gray-600 dark:bg-stone/60 dark:text-gray-100">
                                    {{ __('admin.reports_no_data') }}
                                </div>
                            </template>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function reportCard(report) {
            return {
                period: report.defaultMonth ? 'month' : 'year',
                report,
                piePalette: ['#7c3aed', '#0f766e', '#ea580c', '#2563eb', '#be123c', '#65a30d', '#9333ea', '#0891b2', '#ca8a04', '#4f46e5', '#dc2626', '#059669'],
                selectedMonth: report.defaultMonth,
                selectedYear: report.defaultYear,
                get hasData() {
                    return this.usesSelect
                        ? this.currentOptions.length > 0
                        : this.currentSeries.points.length > 0;
                },
                get usesSelect() {
                    return this.period === 'month' || this.period === 'year';
                },
                get usesBarChart() {
                    return this.period === 'month' || this.period === 'year';
                },
                get usesPieChart() {
                    return this.period === 'country' || this.period === 'region';
                },
                get currentOptions() {
                    return this.period === 'month' ? this.report.monthOptions : this.report.yearOptions;
                },
                get selectedKey() {
                    return this.period === 'month' ? this.selectedMonth : this.selectedYear;
                },
                set selectedKey(value) {
                    if (this.period === 'month') {
                        this.selectedMonth = value;
                        return;
                    }

                    this.selectedYear = value;
                },
                get currentSeries() {
                    const fallback = { points: [], max: 1, total: 0 };

                    if (! this.selectedKey) {
                        return fallback;
                    }

                    if (this.period === 'month') {
                        return this.report.monthSeries[this.selectedKey] || fallback;
                    }

                    if (this.period === 'year') {
                        return this.report.yearSeries[this.selectedKey] || fallback;
                    }

                    return this.period === 'country'
                        ? (this.report.countrySeries || fallback)
                        : (this.report.regionSeries || fallback);
                },
                get summaryLabel() {
                    if (this.period === 'month') {
                        return @js(__('admin.reports_daily_title'));
                    }

                    if (this.period === 'year') {
                        return @js(__('admin.reports_monthly_title'));
                    }

                    return this.period === 'country'
                        ? @js(__('admin.reports_country_distribution'))
                        : @js(__('admin.reports_region_distribution'));
                },
                get chartWidth() {
                    const minimumBarWidth = this.period === 'month' ? 44 : 56;
                    return Math.max(this.currentSeries.points.length * minimumBarWidth, 320);
                },
                get formattedTotal() {
                    return this.formatNumber(this.currentSeries.total || 0);
                },
                get pieStyle() {
                    if (! this.currentSeries.points.length || ! this.currentSeries.total) {
                        return 'background: #e5e7eb;';
                    }

                    let runningPercent = 0;
                    const segments = this.currentSeries.points.map((point, index) => {
                        const start = runningPercent;
                        const size = (point.value / this.currentSeries.total) * 100;
                        runningPercent += size;

                        return `${this.sliceColor(index)} ${start}% ${runningPercent}%`;
                    });

                    return `background: conic-gradient(${segments.join(', ')})`;
                },
                barHeight(value) {
                    const max = this.currentSeries.max || 1;

                    return Math.max((value / max) * 100, value > 0 ? 8 : 0);
                },
                sliceColor(index) {
                    return this.piePalette[index % this.piePalette.length];
                },
                formatNumber(value) {
                    return new Intl.NumberFormat().format(value || 0);
                },
                formatPercent(value) {
                    if (! this.currentSeries.total) {
                        return '0%';
                    }

                    return `${((value / this.currentSeries.total) * 100).toFixed(1)}%`;
                },
            };
        }
    </script>
</x-admin-layout>
