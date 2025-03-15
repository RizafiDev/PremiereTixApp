<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class AppUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'app_users'; // Sesuaikan dengan nama tabel

    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 🔥 Auto-enkripsi password sebelum masuk ke database
}
