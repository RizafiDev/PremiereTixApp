<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Schedule;
use App\Observers\ScheduleObserver; 
use App\Models\TicketTransaction;
use App\Observers\TicketTransactionObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schedule::observe(ScheduleObserver::class);
        TicketTransaction::observe(TicketTransactionObserver::class);
    }
}
