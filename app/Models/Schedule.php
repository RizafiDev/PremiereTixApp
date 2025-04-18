<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['film_id', 'cinema_id', 'show_date', 'show_time', 'studio', 'price'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    // Di model Schedule
public function getLabelAttribute()
{
    return $this->film->title . ' - ' . $this->show_date . ' ' . $this->show_time;
}

}
