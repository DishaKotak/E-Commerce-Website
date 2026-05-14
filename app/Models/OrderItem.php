<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
        'total',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id')
            ->withTrashed();
    }
}
