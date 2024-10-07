@extends('layouts.app')
@include('inc.header')

@section('content')

    <div class="w-3/4 mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">КОРЗИНА</h1>

        @if($cartItems->isEmpty())
            <p class="text-gray-600">Ваша корзина пуста.</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                Перейти к товарам
            </a>
        @else
            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Товар</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Цена</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Количество</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Итого</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ number_format($item->product->price, 2, ',', ' ') }} ₽</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ number_format($item->product->price * $item->quantity, 2, ',', ' ') }} ₽</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <form action="{{ route('carts.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот товар из корзины?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <h3 class="mt-4 text-lg font-semibold">Общая стоимость: <span class="text-green-600">{{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 2, ',', ' ') }} ₽</span></h3>

            <div class="mt-6 text-center">
                <form action="{{ route('orders.store') }}" method="post">
                    @csrf
                    <button class="inline-block px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                        Оформить заказ
                    </button>
                </form>
            </div>
        @endif
    </div>


@endsection
