<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Schedule;
use App\Models\AppUser;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Proses data dari webhook Midtrans
        $transactionData = $request->input();

        // Misal, ID transaksi Midtrans dan status pembayaran
        $transactionId = $transactionData['transaction_id'];
        $paymentStatus = $transactionData['payment_status'];
        $paymentTime = $transactionData['payment_time'];
        $receiptUrl = $transactionData['receipt_url'];

        // Cari transaksi yang sesuai berdasarkan transaction_id
        $transaction = Transaction::where('transaction_id', $transactionId)->first();

        if ($transaction) {
            // Update status pembayaran
            $transaction->update([
                'payment_status' => $paymentStatus,
                'payment_time' => $paymentTime,
                'receipt_url' => $receiptUrl,
            ]);
        }

        // Lakukan tindakan lainnya sesuai kebutuhan (misal: notifikasi, email, dll)
    }
}
