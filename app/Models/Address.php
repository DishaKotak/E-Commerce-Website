<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'email',
        'address_line1',
        'address_line2',
        'state',
        'city',
        'postcode',
        'landmark',
        'address_type',
        'is_primary'
    ];

    // public function adresses()
    // {
    //     return $this->hasMany(Address::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
