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

            // Проверяем наличие товара
            self::checkProductAvailability($cartItems);

            // Рассчитываем общую стоимость и собираем данные о продуктах
            [$totalPrice, $productData] = self::calculateTotalPriceAndProductData($cartItems);

            // Создаем заказ
            $order = Order::create([
                'user_id' => $user->id,
                'date' => now(),
                'products' => json_encode($productData, JSON_UNESCAPED_UNICODE),
                'price' => $totalPrice,
            ]);

            // Обновляем количество товара на складе
            self::updateProductQuantities($cartItems);

            // Очищаем корзину
            Cart::where('user_id', $user->id)->delete();

            DB::commit();
            session()->flash('success', 'Заказ успешно создан');
            return $order;

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            session()->flash('error', $exception->getMessage());
            return null;
        }
    }

    private static function checkProductAvailability(array $cartItems)
    {
        foreach ($cartItems as $item) {
            $product = Product::find($item['product_id']);
            if ($product->quantity < $item['quantity']) {
                throw new \Exception("Недостаточно товара '{$product->name}' на складе. Доступно: {$product->quantity}, Запрашиваемое: {$item['quantity']}");
            }
        }
    }

    private static function calculateTotalPriceAndProductData(array $cartItems): array
    {
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

        return [$totalPrice, $productData];
    }

    private static function updateProductQuantities(array $cartItems)
    {
        foreach ($cartItems as $item) {
            $product = Product::find($item['product_id']);
            $product->decrement('quantity', $item['quantity']);
        }
    }






}
