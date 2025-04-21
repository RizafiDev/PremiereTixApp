<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketTransaction extends Model
{
    protected $fillable = [
        'order_id',
        'appuser_id',
        'schedule_id',
        'seats',
        'gross_amount',
        'status',
        'snap_token',
        'payment_data',
        'expires_at',
        'qr_code_path',

    ];

    protected $casts = [
        'seats' => 'array', // akan menyimpan array of seat_code
    ];

    public function appuser(): BelongsTo
    {
        return $this->belongsTo(AppUser::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }
    public function films(): BelongsTo
    {
        return $this->belongsTo(Film::class);
    }
}
