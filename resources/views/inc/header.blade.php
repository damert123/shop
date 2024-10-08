@section('header')

    <header class="p-4 bg-white shadow-md mb-12">
        <div class="flex justify-evenly items-center">
            <div class="flex items-center space-x-4">
                <div class="logo">
                    <h2 class="font-bold text-2xl text-gray-700">Test-hh</h2>
                </div>
            </div>

            <nav>
                <ul class="flex space-x-4">
                    <li><a href="{{route('dashboard')}}" class="px-4 py-2 text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 transition">Главная</a></li>
                    <li><a href="{{route('products.index')}}" class="px-4 py-2 text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 transition">Продукты</a></li>
                    <li><a href="{{route('orders.index')}}" class="px-4 py-2 text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 transition">Заказы</a></li>
                    <li><a href="{{route('carts.index')}}" class="px-4 py-2 text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 transition">Корзина</a></li>
                </ul>
            </nav>

            <div class="flex items-center space-x-4">
                @if (Auth::check())
                    <p class="text-sm">Пользователь: <strong>{{ Auth::user()->name }}</strong></p>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-700 transition">Выйти</button>
                    </form>

                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-white bg-black rounded-md hover:bg-gray-300 transition">Войти</a>
                @endif
            </div>
        </div>
    </header>


@endsection
