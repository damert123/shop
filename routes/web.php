<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('main.index');
//});

Route::get('/', function () {
    return view('main.index');
})->name('dashboard');




Route::resource('products', ProductController::class);
Route::apiResource('orders', OrderController::class)->middleware('auth');
Route::resource('carts', CartController::class)->middleware('auth');






require __DIR__.'/auth.php';
