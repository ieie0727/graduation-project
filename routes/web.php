<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;

/*---------------------------------------------
// ルート設定
---------------------------------------------*/

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//usersのルート設定
Route::resource('users', UserController::class)->middleware(['auth', 'can:isAdmin']);

//itemsのルート設定
Route::resource('items', ItemController::class)->middleware('auth');
Route::controller(ItemController::class)->prefix('items')->name('items.')->group(function () {
  Route::post('import', 'import')->name('import')->middleware(['auth', 'can:isAdmin']);
});

//ordersのルート設定
Route::resource('orders', OrderController::class)->middleware('auth');
