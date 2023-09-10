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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('url');
            $table->unsignedBigInteger('field_id');
            $table->string('description_en')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('field_id')->references('id')->on('fields');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
