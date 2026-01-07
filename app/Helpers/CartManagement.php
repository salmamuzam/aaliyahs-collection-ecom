<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    // static methods

    // add item to the cart

    static public function addItemToCart($product_id)
    {
        // fetch all cart items from cookie
        $cart_items = self::getCartItemsFromCookie();

        $existing_item = null;

        //  check if current available product is in cookie or not
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        //  if current product is already in the cookie
        if ($existing_item !== null) {
            // update the quantity
            // by 1
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] *
                $cart_items[$existing_item]['unit_amount'];
        }

        // if product is not available in cookie
        // we need to add the product to the cookie
        else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'images']);
            // if product found, add item in cart items
            if ($product) {
                $cart_items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'image' => $product->images[0] ?? 'uploads/placeholder.png',
                    'quantity' => 1,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price
                ];

            }
        }
        // add to cookie
        self::addCartItemsToCookie($cart_items);
        return self::calculateTotalCount($cart_items);
    }


    // add item to the cart with quantity

    static public function addItemToCartWithQty($product_id, $qty = 1)
    {
        // fetch all cart items from cookie
        $cart_items = self::getCartItemsFromCookie();

        $existing_item = null;

        //  check if current available product is in cookie or not
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        //  if current product is already in the cookie
        if ($existing_item !== null) {
            // update the quantity
            $cart_items[$existing_item]['quantity'] += $qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] *
                $cart_items[$existing_item]['unit_amount'];
        }

        // if product is not available in cookie
        // we need to add the product to the cookie
        else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'images']);
            // if product found, add item in cart items
            if ($product) {
                $cart_items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'image' => $product->images[0] ?? 'uploads/placeholder.png',
                    'quantity' => $qty,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price
                ];

            }
        }
        // add to cookie
        self::addCartItemsToCookie($cart_items);
        return self::calculateTotalCount($cart_items);
    }
    // remove item from the cart

    static public function removeCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                // remove item from cart items
                unset($cart_items[$key]);

            }

        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // add cart items to cookie

    static public function addCartItemsToCookie($cart_items)
    {
        // cookie expires in 30 days
        // saved in browser for 30 days
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    // clear cart items from cookie

    static public function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }


    // get all cart items from cookie

    static public function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        // if no cart item
        if (!$cart_items) {
            $cart_items = [];
        }
        return $cart_items;
    }


    // increment item quantity

    static public function incrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            // if item is found in cookie
            if ($item['product_id'] == $product_id) {
                // increase the quantity
                $cart_items[$key]['quantity']++;
                // update total amount according to the updated quantity
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }
        // add updated cart item in the cookie again
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // decrement item quantity

    static public function decrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                if ($cart_items[$key]['quantity'] > 1) {
                    // decrease the quantity
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                }


            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // calculate grand total
    static public function calculateGrandTotal($items)
    {
        return array_sum(array_column($items, 'total_amount'));
    }

    // calculate total item count (sum of quantities)
    static public function calculateTotalCount($items)
    {
        return array_sum(array_column($items, 'quantity'));
    }

}
