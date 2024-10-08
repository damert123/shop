<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{

    public static function create(array $data): Cart
    {
        $userId = Auth::id();
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $data['product_id'])->first();
        if ($cartItem) {
            $cartItem->quantity += $data['quantity'];
            $cartItem->save();
            return $cartItem;
        } else {
            $data['user_id'] = $userId;
            return Cart::create($data);
        }
    }

    public static function calculateTotalPrice($cartItems)
    {
        foreach ($cartItems as $item) {
            $item->totalPrice = number_format($item->product->price * $item->quantity);
        }

        return $cartItems;
    }

}
