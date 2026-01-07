<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

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

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(get: fn() => "{$this->first_name} {$this->last_name}");
    }

    protected function firstName(): Attribute
    {
        return Attribute::make(set: fn($v) => ucwords(strtolower($v)));
    }

    protected function lastName(): Attribute
    {
        return Attribute::make(set: fn($v) => ucwords(strtolower($v)));
    }

    protected function city(): Attribute
    {
        return Attribute::make(set: fn($v) => ucwords(strtolower($v)));
    }
}
