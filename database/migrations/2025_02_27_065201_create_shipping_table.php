<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipping', function (Blueprint $table) {
            $table->id('shipping_id');
            $table->unsignedBigInteger('order_id'); // Ensure it's unsigned
            $table->unsignedBigInteger('user_id');  // Ensure it's unsigned
            $table->text('address');
            $table->enum('status', ['pending', 'shipped', 'delivered'])->default('pending');
            $table->string('tracking_number', 100)->nullable();
            $table->timestamps();

            // Define foreign keys explicitly
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping');
    }
};
