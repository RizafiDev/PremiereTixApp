<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', // Menghubungkan dengan pengguna
        'schedule_id', // Menghubungkan dengan jadwal film yang dibeli
        'total_price', // Total harga transaksi
        'payment_status', // Status pembayaran (contoh: pending, success, failed)
        'transaction_id', // ID transaksi dari Midtrans
        'payment_method', // Metode pembayaran (contoh: Midtrans)
        'payment_time', // Waktu transaksi berhasil
        'receipt_url', // URL dari tanda terima pembayaran Midtrans
    ];

    // Relasi dengan pengguna
    public function user()
    {
        return $this->belongsTo(AppUser::class, 'user_id');
    }

    // Relasi dengan jadwal film
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
