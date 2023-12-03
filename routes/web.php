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
Route::resource('users', UserController::class)->middleware(['auth', 'can:isAdmin']);
Route::resource('items', ItemController::class)->middleware('auth');
Route::resource('orders', OrderController::class)->middleware('auth');
