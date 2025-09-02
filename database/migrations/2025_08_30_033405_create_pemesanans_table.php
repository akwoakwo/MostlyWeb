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
        Schema::create('pemesanans', function (Blueprint $table) {
            // Kolom yang sudah ada
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('subpaket_id')->constrained('detail_pakets');
            $table->foreignId('produk_id')->nullable()->constrained('produks');
            $table->text('catatan')->nullable();

            // Kolom baru untuk pembayaran Midtrans
            $table->string('invoice_number')->unique();
            $table->string('domain')->nullable();
            $table->integer('total_harga');
            $table->enum('status_pembayaran', ['pending', 'success', 'failed', 'expired', 'cancelled'])->default('pending');
            $table->string('token_midtrans')->nullable();
            $table->string('metode_pembayaran')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
