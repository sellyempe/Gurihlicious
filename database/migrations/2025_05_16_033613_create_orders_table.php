<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // nullable jika checkout tanpa login
            $table->string('name');
            $table->string('phone');
            $table->text('address');
            $table->enum('status', ['pending', 'diproses', 'disiapkan', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
            $table->decimal('total_price', 12, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
