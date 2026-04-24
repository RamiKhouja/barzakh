<?php

namespace App\Services\GeoIp;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use MaxMind\Db\Reader\InvalidDatabaseException;
use Throwable;

class MaxMindGeoLiteService
{
    protected ?Reader $reader = null;

    protected bool $readerResolved = false;

    public function isAvailable(): bool
    {
        return $this->reader() !== null;
    }

    public function databasePath(): string
    {
        return (string) config('maxmind.database_path');
    }

    public function lookup(?string $ipAddress): ?array
    {
        if (! is_string($ipAddress) || $ipAddress === '' || $this->isPrivateOrInvalidIp($ipAddress)) {
            return null;
        }

        $reader = $this->reader();

        if (! $reader) {
            return null;
        }

        try {
            $record = $reader->city($ipAddress);
        } catch (AddressNotFoundException|InvalidDatabaseException|Throwable) {
            return null;
        }

        return [
            'country_code' => $record->country->isoCode ?: null,
            'country_name' => $record->country->name ?: null,
            'region_code' => $record->mostSpecificSubdivision->isoCode ?: null,
            'region_name' => $record->mostSpecificSubdivision->name ?: null,
            'city_name' => $record->city->name ?: null,
        ];
    }

    protected function reader(): ?Reader
    {
        if ($this->readerResolved) {
            return $this->reader;
        }

        $this->readerResolved = true;

        if (! class_exists(Reader::class)) {
            return null;
        }

        $databasePath = $this->databasePath();

        if ($databasePath === '' || ! is_file($databasePath)) {
            return null;
        }

        try {
            $this->reader = new Reader($databasePath);
        } catch (Throwable) {
            $this->reader = null;
        }

        return $this->reader;
    }

    protected function isPrivateOrInvalidIp(string $ipAddress): bool
    {
        if (! filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            return true;
        }

        return filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false;
    }
}
