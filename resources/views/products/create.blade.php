@extends('layouts.app')
@include('inc.header')

@section('content')

    <div class="w-1/2 mx-auto">
        <h1 class="text-2xl font-bold mb-4">Добавить товар</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Название товара</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Описание товара</label>
                <textarea name="description" id="description"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
            </div>

            <div class="mb-4 flex space-x-4">
                <div class="w-1/2">
                    <label for="price" class="block text-sm font-medium text-gray-700">Цена</label>
                    <input type="number" name="price" id="price" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>

                <div class="w-1/2">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Количество</label>
                    <input type="number" name="quantity" id="quantity" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Изображение</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 transition">Добавить товар</button>
        </form>
    </div>


@endsection
