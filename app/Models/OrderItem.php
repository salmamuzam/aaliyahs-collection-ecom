<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_amount',
        'total_amount',
    ];

    // Every order item belongs to one order

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Every order item belongs to one product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
