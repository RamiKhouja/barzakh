<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('country_code', 8)->nullable()->after('ip_address')->index();
            $table->string('country_name')->nullable()->after('country_code')->index();
            $table->string('region_code', 16)->nullable()->after('country_name');
            $table->string('region_name')->nullable()->after('region_code')->index();
            $table->string('city_name')->nullable()->after('region_name');
            $table->timestamp('geolocated_at')->nullable()->after('last_visited_at')->index();
        });
    }

    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropIndex(['country_code']);
            $table->dropIndex(['country_name']);
            $table->dropIndex(['region_name']);
            $table->dropIndex(['geolocated_at']);
            $table->dropColumn([
                'country_code',
                'country_name',
                'region_code',
                'region_name',
                'city_name',
                'geolocated_at',
            ]);
        });
    }
};
