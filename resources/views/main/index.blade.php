@extends('layouts.app')
@include('inc.header')

@section('content')




<div class="w-4/5 mx-auto">

    <div class="flex justify-center">
        <a href="{{route('products.create')}}" class="px-4 py-2 text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 transition">Добавить товар</a>
    </div>

</div>




@endsection
