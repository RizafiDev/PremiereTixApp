<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Illuminate\Support\Facades\Storage;
use App\Models\TicketTransaction;

class QRCodeService
{
    /**
     * Generate a QR code for a ticket transaction
     *
     * @param TicketTransaction $transaction
     * @return string The path to the generated QR code
     */
    public static function generateTicketQR(TicketTransaction $transaction): string
    {
        $filename = 'qr_tickets/ticket_' . $transaction->order_id . '.png';

        $qrData = json_encode([
            'order_id' => $transaction->order_id,
            'film' => $transaction->schedule->film->title ?? 'Unknown',
            'cinema' => $transaction->schedule->cinema->name ?? 'Unknown',
            'date' => $transaction->schedule->show_date ?? 'Unknown',
            'time' => $transaction->schedule->show_time ?? 'Unknown',
            'seats' => $transaction->seats ?? 'Unknown',
            'price' => $transaction->gross_amount ?? 'Unknown',
            'studio' => $transaction->schedule->cinema->studio ?? 'Unknown',
            'transaction_id' => $transaction->id,
        ]);

        // Generate QR code using endroid/qr-code
        $result = Builder::create()
            ->data($qrData)
            ->size(300)
            ->margin(10)
            ->build();

        // Pastikan folder ada
        $directory = Storage::disk('public')->path('qr_tickets');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Simpan ke disk public
        Storage::disk('public')->put($filename, $result->getString());

        return $filename;
    }
}
