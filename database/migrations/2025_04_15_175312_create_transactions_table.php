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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('app_users')->onDelete('cascade');
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade');
            $table->decimal('total_price', 10, 2); // Total harga
            $table->string('payment_status'); // Status pembayaran
            $table->string('transaction_id')->unique(); // ID transaksi Midtrans
            $table->string('payment_method'); // Metode pembayaran (misal: Midtrans)
            $table->timestamp('payment_time'); // Waktu pembayaran berhasil
            $table->string('receipt_url'); // URL untuk tanda terima pembayaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
