<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TicketTransaction;
use App\Services\QRCodeService;

class GenerateMissingQRCodes extends Command
{
    protected $signature = 'tickets:generate-qr-codes';

    protected $description = 'Generate QR codes for ticket transactions that do not have one';

    public function handle()
    {
        $this->info('Starting to generate missing QR codes...');

        // Get all successful ticket transactions without QR codes
        $transactions = TicketTransaction::where('status', 'success')
            ->whereNull('qr_code_path')
            ->get();

        $count = 0;
        foreach ($transactions as $transaction) {
            // Generate QR code
            $qrCodePath = QRCodeService::generateTicketQR($transaction);
            
            // Update the model
            $transaction->qr_code_path = $qrCodePath;
            $transaction->save();
            
            $count++;
            $this->info("Generated QR code for transaction {$transaction->order_id}");
        }

        $this->info("Completed! Generated $count QR codes.");
        
        return Command::SUCCESS;
    }
}