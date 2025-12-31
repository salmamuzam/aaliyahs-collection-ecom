<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class FavoritesManagement
{
    // add item to the favorites
    static public function addItemToFavorites($product_id)
    {
        $favorite_items = self::getFavoriteItemsFromCookie();

        $existing_item = null;

        foreach ($favorite_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item === null) {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'images']);
            if ($product) {
                $favorite_items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'image' => $product->images[0] ?? 'uploads/placeholder.png',
                    'unit_amount' => $product->price,
                ];
            }
        }

        self::addFavoriteItemsToCookie($favorite_items);
        return count($favorite_items);
    }

    // remove item from the favorites
    static public function removeFavoriteItem($product_id)
    {
        $favorite_items = self::getFavoriteItemsFromCookie();
        foreach ($favorite_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($favorite_items[$key]);
            }
        }
        self::addFavoriteItemsToCookie($favorite_items);
        return array_values($favorite_items);
    }

    // add favorite items to cookie
    static public function addFavoriteItemsToCookie($favorite_items)
    {
        Cookie::queue('favorite_items', json_encode(array_values($favorite_items)), 60 * 24 * 30);
    }

    // clear favorite items from cookie
    static public function clearFavoriteItems()
    {
        Cookie::queue(Cookie::forget('favorite_items'));
    }

    // get all favorite items from cookie
    static public function getFavoriteItemsFromCookie()
    {
        $favorite_items = json_decode(Cookie::get('favorite_items'), true);
        if (!$favorite_items) {
            $favorite_items = [];
        }
        return $favorite_items;
    }
}
