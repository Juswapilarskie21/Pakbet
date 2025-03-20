<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id('inventory_id');
            $table->foreignId('variant_id')->constrained('product_variants', 'variant_id')->onDelete('cascade');
            $table->enum('change_type', ['add', 'remove']);
            $table->integer('quantity');
            $table->string('reason', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory');
    }
};
