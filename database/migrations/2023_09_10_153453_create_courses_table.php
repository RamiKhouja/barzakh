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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('url');
            $table->string('description_en')->nullable();
            $table->string('description_ar')->nullable();
            $table->unsignedBigInteger('instructor_id');
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->float('discount', 4, 2)->nullable();
            $table->integer('nb_lessons')->default(0);
            $table->bigInteger('duration')->default(0); //in seconds
            $table->enum('level', ['beginner','intermediate','advanced', 'expert'])->nullable();
            $table->integer('nb_subscriptions')->default(0);
            $table->boolean('is_free')->default(false);
            $table->string('language')->nullable();
            $table->json('translations')->nullable();
            $table->json('requirements_en')->nullable();
            $table->json('requirements_ar')->nullable();
            $table->string('image')->nullable();
            $table->string('featured_vid')->nullable();
            $table->float('rating',2,1)->nullable();
            $table->integer('nb_files')->default(0);
            $table->integer('nb_exercices')->default(0);
            $table->boolean('is_chosen')->default(false);
            $table->integer('nb_visits')->default(0);
            $table->timestamps();

            $table->foreign('instructor_id')->references('id')->on('instructors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
