@extends('layouts.app')
@include('inc.header')

@section('content')


    <div class="w-4/5 mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-8">Список товаров</h1>
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" style="width: 80%; margin: 0 auto;">
            @foreach($products as $product)
                <div class="border m-5 rounded-lg shadow-lg p-4 bg-white flex flex-col justify-between">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/150' }}" alt="Изображение товара" class="w-full h-48 object-cover rounded-md mb-4">

                    <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600">{{ $product->description }}</p>
                    <div class="mt-4">
                        <span class="text-lg font-bold text-blue-500">Цена: {{ $product->price }} ₽</span>
                    </div>
                    <div class="mt-2">
                        <span class="text-sm text-gray-500">Количество: {{ $product->quantity }}</span>
                    </div>

                    <form action="{{route('carts.store')}}" method="post" class="mt-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" min="1" value="1" class="w-full border rounded-md p-2">
                        <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700 transition mt-2">
                            Купить
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>


@endsection
