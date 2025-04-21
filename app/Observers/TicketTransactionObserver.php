<?php

namespace App\Observers;

use App\Models\TicketTransaction;
use App\Services\QRCodeService;

class TicketTransactionObserver
{
    /**
     * Handle the TicketTransaction "updated" event.
     */
    public function updated(TicketTransaction $ticketTransaction): void
    {
        // Generate QR code when status changes to success and no QR code exists yet
        if ($ticketTransaction->status === 'success' && empty($ticketTransaction->qr_code_path)) {
            // Generate QR code
            $qrCodePath = QRCodeService::generateTicketQR($ticketTransaction);
            
            // Update the model without triggering observers to prevent infinite loop
            $ticketTransaction->timestamps = false;
            $ticketTransaction->qr_code_path = $qrCodePath;
            $ticketTransaction->save();
            $ticketTransaction->timestamps = true;
        }
    }
}