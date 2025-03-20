<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_code', 50)->unique();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('categories', 'category_id')->onDelete('cascade');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
