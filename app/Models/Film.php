<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'release_date', 'rating', 'country', 'genre', 'photo', 'playing'
    ];

    protected $casts = [
        'genre' => 'array', // Mengubah kolom genre menjadi array agar bisa menyimpan multiple ID
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'film_genre', 'film_id', 'genre_id');
    }
}

