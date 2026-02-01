<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'category_id', 'price', 'images'];

    /**
     * PERFORMANCE: Eager load relationships by default to prevent N+1 issues
     */
    protected $with = ['category'];

    protected function casts(): array
    {
        return ['images' => 'array'];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopePriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    protected function formattedPrice(): Attribute
    {
        return Attribute::make(get: fn() => 'LKR ' . number_format($this->price, 2));
    }

    /**
     * AUTO-MAINTENANCE: Invalidate relevant caches when products change
     */
    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('home_latest_products');
            \Illuminate\Support\Facades\Cache::forget('home_best_sellers');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('home_latest_products');
            \Illuminate\Support\Facades\Cache::forget('home_best_sellers');
        });
    }
}
