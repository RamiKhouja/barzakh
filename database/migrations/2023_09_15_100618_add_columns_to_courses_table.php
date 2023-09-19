<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->text('description_en')->nullable()->change();
            $table->text('description_ar')->nullable()->change();
            $table->boolean('show')->default(true);
            $table->boolean('is_discount')->default(false);
            $table->date('discount_start')->nullable();
            $table->date('discount_end')->nullable();
            $table->json('tags')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('show');
            $table->dropColumn('is_discount');
            $table->dropColumn('discount_start');
            $table->dropColumn('discount_end');
            $table->dropColumn('tags');
        });
    }
};
