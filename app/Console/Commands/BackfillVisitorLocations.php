<?php

namespace App\Console\Commands;

use App\Models\Visitor;
use App\Services\GeoIp\MaxMindGeoLiteService;
use Illuminate\Console\Command;

class BackfillVisitorLocations extends Command
{
    protected $signature = 'visitors:geoip-backfill
                            {--force : Refresh visitors that already have geolocation data}
                            {--chunk=200 : Number of visitors to process per chunk}';

    protected $description = 'Backfill visitor country and region data using the configured MaxMind GeoLite2 database.';

    public function handle(MaxMindGeoLiteService $geoIpService): int
    {
        if (! $geoIpService->isAvailable()) {
            $this->error('MaxMind GeoLite2 database not found.');
            $this->line('Expected path: '.$geoIpService->databasePath());

            return self::FAILURE;
        }

        $chunkSize = max((int) $this->option('chunk'), 1);
        $force = (bool) $this->option('force');
        $processed = 0;
        $updated = 0;

        $query = Visitor::query()
            ->whereNotNull('ip_address')
            ->orderBy('id');

        if (! $force) {
            $query->whereNull('geolocated_at');
        }

        $total = (clone $query)->count();

        if ($total === 0) {
            $this->info('No visitors need geolocation backfill.');

            return self::SUCCESS;
        }

        $progressBar = $this->output->createProgressBar($total);
        $progressBar->start();

        $query->chunkById($chunkSize, function ($visitors) use ($geoIpService, $progressBar, &$processed, &$updated) {
            foreach ($visitors as $visitor) {
                $location = $geoIpService->lookup($visitor->ip_address);

                $visitor->forceFill([
                    'country_code' => data_get($location, 'country_code'),
                    'country_name' => data_get($location, 'country_name'),
                    'region_code' => data_get($location, 'region_code'),
                    'region_name' => data_get($location, 'region_name'),
                    'city_name' => data_get($location, 'city_name'),
                    'geolocated_at' => now(),
                ])->saveQuietly();

                $processed++;

                if ($location) {
                    $updated++;
                }

                $progressBar->advance();
            }
        });

        $progressBar->finish();
        $this->newLine(2);
        $this->info("Processed {$processed} visitors.");
        $this->info("Resolved location data for {$updated} visitors.");

        return self::SUCCESS;
    }
}
