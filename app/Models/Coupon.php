<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['code','discount','is_active','expired_at', 'name', 'description', 'snk', 'coupon_banner_path'];
}
