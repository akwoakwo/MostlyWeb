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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->constrained('pemesanans')->unique();
            $table->string('transaction_id_midtrans')->unique();
            $table->string('order_id_midtrans');
            $table->integer('total_amount');
            $table->string('payment_method');
            $table->string('issuer')->nullable();
            $table->string('acquirer')->nullable();
            $table->string('reference_number')->nullable();
            $table->enum('status', ['pending', 'settlement', 'capture', 'expire', 'cancel', 'deny', 'refund']);
            $table->timestamp('transaction_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
