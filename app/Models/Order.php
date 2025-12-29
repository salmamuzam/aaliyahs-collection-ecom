<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'grand_total', 'payment_method', 'payment_status', 'status', 'currency', 'shipping_amount', 'shipping_method', 'notes'];

    // One order belongs to a user
    // A user can have multiple orders
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Order contains multiple items
    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    // Order can have one address
    public function address(){
        return $this->hasOne(Address::class);
    }
}
