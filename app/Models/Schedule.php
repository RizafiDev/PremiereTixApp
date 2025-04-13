<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    protected $fillable = ['film_id', 'show_time', 'studio'];

    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class);
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }
}
