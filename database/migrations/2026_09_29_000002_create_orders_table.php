<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pending', 'delivery', 'done', 'canceled']);
            $table->double('subtotal', 10, 3);
            $table->double('delivery', 5, 3)->default(8);
            $table->double('total', 10, 3);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->json('client');
            $table->text('message');
            $table->enum('language', ['en', 'ar', 'fr']);
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
