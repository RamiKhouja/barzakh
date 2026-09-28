<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('url')->unique();
            $table->text('short_description_en')->nullable();
            $table->text('short_description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('main_image')->nullable();
            $table->double('price', 10, 3)->default(0);
            $table->double('discount_price', 10, 3)->nullable();
            $table->boolean('is_free')->default(false);
            $table->boolean('is_discount')->default(false);
            $table->unsignedBigInteger('nb_visits')->default(0);
            $table->unsignedBigInteger('nb_buyers')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('show')->default(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_sold')->default(false);
            $table->boolean('is_soon')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
