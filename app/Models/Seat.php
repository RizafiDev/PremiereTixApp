<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    protected $fillable = ['schedule_id', 'seat_code', 'is_booked'];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

}
