<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
   
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Creates `BIGINT UNSIGNED AUTO_INCREMENT PRIMARY`
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('rating')->check('rating BETWEEN 1 AND 5'); // Alternative CHECK for MySQL 8+
            $table->text('comment')->nullable();
            $table->timestamps();

            // Define foreign keys explicitly
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        // For MySQL 8+, CHECK is supported in the column definition above.
        // If using an older version of MySQL (5.7 or MariaDB), enforce rating validation in Laravel.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
