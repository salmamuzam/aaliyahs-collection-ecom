<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'street_address',
        'city',
        'province',
        'postal_code',
        'country',
    ];

    // Every order has only one address
    public function Order()
    {
        return $this->belongsTo(Order::class);
    }

    // create full name
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
