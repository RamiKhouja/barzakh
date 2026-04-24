<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use App\Services\GeoIp\MaxMindGeoLiteService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    public function __construct(
        protected MaxMindGeoLiteService $geoIpService
    ) {
    }

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldTrack($request)) {
            $sessionId = $request->session()->getId();

            if (! empty($sessionId)) {
                $now = now();
                $ipAddress = $request->ip();
                $visitor = Visitor::firstOrNew(['session_id' => $sessionId]);

                if (! $visitor->exists) {
                    $visitor->first_visited_at = $now;
                }

                $shouldRefreshLocation = $ipAddress !== $visitor->ip_address || $visitor->geolocated_at === null;
                $visitor->ip_address = $ipAddress;
                $visitor->user_agent = $request->userAgent();
                $visitor->last_visited_at = $now;

                if ($shouldRefreshLocation && is_string($ipAddress) && $ipAddress !== '') {
                    $location = $this->geoIpService->lookup($ipAddress);

                    $visitor->country_code = data_get($location, 'country_code');
                    $visitor->country_name = data_get($location, 'country_name');
                    $visitor->region_code = data_get($location, 'region_code');
                    $visitor->region_name = data_get($location, 'region_name');
                    $visitor->city_name = data_get($location, 'city_name');
                    $visitor->geolocated_at = $now;
                }

                $visitor->save();
            }
        }

        return $next($request);
    }

    protected function shouldTrack(Request $request): bool
    {
        return $request->isMethod('get')
            && ! $request->expectsJson()
            && ! $request->is('admin', 'admin/*');
    }
}
