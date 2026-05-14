<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'name',
        'type',
        'discount_amount',
        'start_at',
        'expire_at',
        'status',
    ];
}
