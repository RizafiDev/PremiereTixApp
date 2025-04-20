<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TicketTransaction;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;

class DeleteExpiredTransactions extends Command
{
    protected $signature = 'transactions:clean-expired';
    protected $description = 'Delete expired transactions and unbook associated seats';

    public function handle()
    {
        $expiredTransactions = TicketTransaction::where('status', '!=', 'success')
            ->where('expires_at', '<', now())
            ->get();

        if ($expiredTransactions->isEmpty()) {
            $this->info('Tidak ada transaksi expired.');
            return;
        }

        DB::transaction(function () use ($expiredTransactions) {
            foreach ($expiredTransactions as $transaction) {
                // Unbook seat
                Seat::where('schedule_id', $transaction->schedule_id)
                    ->whereIn('seat_code', $transaction->seats)
                    ->update(['is_booked' => false]);

                // Hapus transaksi
                $transaction->delete();
            }
        });

        $this->info('Expired transactions deleted dan kursi di-unbook.');
    }
}
