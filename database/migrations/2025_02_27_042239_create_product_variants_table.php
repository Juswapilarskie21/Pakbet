<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id('variant_id');
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade');
            $table->string('sku', 50)->unique();
            $table->string('size', 50);
            $table->string('color', 50);
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->decimal('weight', 10, 2);
            $table->decimal('height', 10, 2);
            $table->decimal('width', 10, 2);
            $table->string('image_url', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
};
