<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    protected $fillable = ['name', 'image'];

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('home_categories');
            \Illuminate\Support\Facades\Cache::forget('shop_categories');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('home_categories');
            \Illuminate\Support\Facades\Cache::forget('shop_categories');
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
