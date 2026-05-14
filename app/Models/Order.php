<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Address;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'order';

    protected $fillable = [
        'tracking_id',
        'order_date',
        'user_id',
        'shipping_address',
        'billing_address',
        'shipping_address_id',
        'billing_address_id',
        'total_amount',
        'phone_no',
        'status',
        'discount',
        'final_amount',
    ];

    protected $casts = [
        'order_date' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(\App\Models\OrderItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    public function billingAddress()
    {
        return $this->belongsTo(Address::class, 'billing_address_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->tracking_id = 'TRK-' . strtoupper(Str::random(10));
        });
    }
}
