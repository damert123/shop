
@extends('layouts.app')
@include('inc.header')

@section('content')




<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold text-center mb-8">Редактирование корзины</h1>

    @if($cartItems->isEmpty())
        <div class="text-center">
            <p class="text-gray-600">Ваша корзина пуста.</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                Перейти к товарам
            </a>
        </div>
    @else
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            @method('PUT')
            <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 text-left">Товар</th>
                    <th class="py-2 px-4 text-left">Цена</th>
                    <th class="py-2 px-4 text-left">Количество</th>
                    <th class="py-2 px-4 text-left">Итого</th>
                    <th class="py-2 px-4 text-left">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $item)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $item->product->name }}</td>
                        <td class="py-2 px-4">{{ $item->product->price }} ₽</td>
                        <td class="py-2 px-4">
                            <input type="number" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" class="w-16 border rounded-md text-center" required>
                        </td>
                        <td class="py-2 px-4">{{ $item->product->price * $item->quantity }} ₽</td>
                        <td class="py-2 px-4">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                <h2 class="text-xl font-bold">Общая стоимость: {{ $cartItems->sum(function($item) { return $item->product->price * $item->quantity; }) }} ₽</h2>
            </div>

            <div class="mt-6">
                <button type="submit" class="inline-block px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                    Сохранить изменения
                </button>
            </div>
        </form>
    @endif
</div>


@endsection
