<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'category_id', 'price', 'image'];

    // Every product belongs to one category
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
