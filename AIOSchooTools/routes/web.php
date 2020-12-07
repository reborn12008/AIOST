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

Route::get('/aluno/shop', [App\Http\Controllers\ShopController::class,'index'])->name('aluno_shop');
Route::get('/aluno/shop/{category}', [App\Http\Controllers\ShopController::class,'filterCategory'])->name('shop_filter');
Route::get('/aluno/shop/request/{product}', [App\Http\Controllers\ShopController::class,'item'])->name('shop_item');
Route::post('/aluno/shop/request/{product}/finish', [App\Http\Controllers\ShopController::class,'storeItem'])->name('item_finish');
Route::get('/aluno/shop/request/{product}', [App\Http\Controllers\ShopController::class,'item'])->name('shop_item');
Route::get('/aluno/cart', [App\Http\Controllers\ShopController::class,'confirm_request'])->name('item_cart');
Route::get('/aluno/cart/delete', [App\Http\Controllers\ShopController::class,'delete_cart'])->name('delete_cart');
Route::post('/aluno/cart/confirm', [App\Http\Controllers\ShopController::class,'confirm_cart'])->name('confirm_cart')->middleware('checks_amount_cart');
Route::get('/aluno/rooms', [App\Http\Controllers\RoomsController::class,'roomform'])->name('aluno_room');
Route::post('/aluno/rooms/given_room', [App\Http\Controllers\RoomsController::class,'given_room'])->name('room_given')->middleware('room_form_check');
//
Route::get('/docente/mapa_salas', [App\Http\Controllers\RoomsController::class,'roomsmap'])->name('docente_room');
Route::post('/docente/mapa_salas', [App\Http\Controllers\RoomsController::class,'map'])->name('roommap')->middleware('map_form_check');

Route::get('/admnistrador/stock', [App\Http\Controllers\ShopController::class, 'stock_page'])->name('stock_page');
Route::get('/admnistrador/stock/new_item', [App\Http\Controllers\ShopController::class, 'create_material_page'])->name('add_item_page');
Route::get('/admnistrador/stock/{item}/edit', [App\Http\Controllers\ShopController::class, 'edit_item'])->name('edit_item');
Route::post('/admnistrador/stock/{item}/update', [App\Http\Controllers\ShopController::class, 'update_item'])->name('update_item')->middleware('update_form_check');
Route::post('/admnistrador/new_material', [App\Http\Controllers\ShopController::class, 'insert_material'])->name('insert_material')->middleware('insert_form_check');




