<?php

namespace App\Providers;

use App\Services\GeoIp\MaxMindGeoLiteService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(MaxMindGeoLiteService::class, fn () => new MaxMindGeoLiteService());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
