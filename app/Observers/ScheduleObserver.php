<?php

namespace App\Observers;

use App\Models\Schedule;
use App\Models\Seat;

class ScheduleObserver
{
    /**
     * Handle the Schedule "created" event.
     */
    public function created(Schedule $schedule): void
    {
        $rows = ['A', 'B', 'C', 'D', 'E'];
        $columns = range(1, 10); // 10 kursi per baris

        foreach ($rows as $row) {
            foreach ($columns as $col) {
                Seat::create([
                    'schedule_id' => $schedule->id,
                    'seat_code' => $row . $col,
                    'is_booked' => false,
                    'booked_by' => null,
                ]);
            }
        }
    }

    /**
     * Handle the Schedule "updated" event.
     */
    public function updated(Schedule $schedule): void
    {
        //
    }

    /**
     * Handle the Schedule "deleted" event.
     */
    public function deleted(Schedule $schedule): void
    {
        //
    }

    /**
     * Handle the Schedule "restored" event.
     */
    public function restored(Schedule $schedule): void
    {
        //
    }

    /**
     * Handle the Schedule "force deleted" event.
     */
    public function forceDeleted(Schedule $schedule): void
    {
        //
    }
}
