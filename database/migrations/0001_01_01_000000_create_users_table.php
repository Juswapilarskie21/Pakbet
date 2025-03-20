<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id'); // Primary Key with Auto-Increment
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->enum('user_type', ['customer', 'admin']);
            $table->timestamps(); // Auto-created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
