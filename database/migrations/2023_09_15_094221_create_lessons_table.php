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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('video_url');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('course_id');
            $table->string('url');
            $table->integer('number')->default(1);
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->bigInteger('duration')->nullable();
            $table->boolean('is_free')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->integer('nb_watched')->default(0);
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
