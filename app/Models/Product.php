<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'category_id', 'price', 'images'];

    protected function casts(): array
    {
        return ['images' => 'array'];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    protected function formattedPrice(): Attribute
    {
        return Attribute::make(get: fn() => 'LKR ' . number_format($this->price, 2));
    }
}
