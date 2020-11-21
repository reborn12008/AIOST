<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home/{user}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home/aluno/shop', [App\Http\Controllers\ShopController::class,'index'])->name('aluno_shop');
Route::get('/home/aluno/shop', [App\Http\Controllers\ShopController::class,'index'])->name('aluno_shop');
Route::get('/home/aluno/shop/{category}', [App\Http\Controllers\ShopController::class,'filterCategory'])->name('shop_filter');
Route::get('/home/aluno/shop/request/{product}', [App\Http\Controllers\ShopController::class,'item'])->name('shop_item');
Route::post('/home/aluno/shop/request/{product}/finish', [App\Http\Controllers\ShopController::class,'storeItem'])->name('item_finish');
Route::get('/home/aluno/shop/request/{product}', [App\Http\Controllers\ShopController::class,'item'])->name('shop_item');
Route::get('/home/aluno/cart', [App\Http\Controllers\ShopController::class,'confirm_request'])->name('item_cart');
Route::get('/home/aluno/cart/delete', [App\Http\Controllers\ShopController::class,'delete_cart'])->name('delete_cart');
Route::post('/home/aluno/cart/confirm', [App\Http\Controllers\ShopController::class,'confirm_cart'])->name('confirm_cart');
Route::get('/home/aluno/rooms', [App\Http\Controllers\RoomsController::class,'index'])->name('aluno_room');
//
Route::get('/home/docente/mapa.salas', [App\Http\Controllers\RoomsController::class,'roomsmap'])->name('docente_room');
//
//Route::get('/home/admnistrador/gerir.stock', );




