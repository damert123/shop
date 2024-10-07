<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{

    public static function create(array $cartItems): ?Order
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();

            $totalPrice = collect($cartItems)->sum(function ($item) {
                $product = Product::find($item['product_id']);
                return $product->price * $item['quantity'];
            });

            $productData = collect($cartItems)->map(function ($item) {
                $product = Product::find($item['product_id']);
                return [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                ];
            });

            $order = Order::create([
                'user_id' => $user->id,
                'date' => now(),
                'products' => json_encode($productData, JSON_UNESCAPED_UNICODE),
                'price' => $totalPrice,
            ]);


            Cart::where('user_id', $user->id)->delete();

            DB::commit();
            return $order;

        }catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());

        }


    }

}
