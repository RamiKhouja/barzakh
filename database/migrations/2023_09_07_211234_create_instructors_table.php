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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->json('firstname');
            $table->json('lastname');
            $table->json('short_desc')->nullable();
            $table->json('description')->nullable();
            $table->string('email')->unique();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('image')->nullable();
            $table->integer('nb_courses')->default(0);
            $table->integer('nb_views')->default(0);
            $table->integer('nb_students')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
