<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'grand_total',
        'payment_method',
        'payment_status',
        'status',
        'currency',
        'shipping_amount',
        'shipping_method',
        'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', ['new', 'processing']);
    }

    public function scopeCompleted($query)
    {
        return $query->whereIn('status', ['delivered', 'cancelled']);
    }

    protected static function booted()
    {
        static::updating(function ($order) {
            if ($order->getOriginal('status') === 'delivered' && $order->status !== 'delivered') {
                // Rule: Cannot edit a 'delivered' order
            }
        });

        static::creating(fn($order) => $order->currency ??= 'lkr');
    }

    protected function formattedTotal(): Attribute
    {
        return Attribute::make(get: fn() => 'LKR ' . number_format($this->grand_total, 2));
    }
}
