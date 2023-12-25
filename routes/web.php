<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MailController;

/*---------------------------------------------
// ルート設定
---------------------------------------------*/

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');

//usersのルート設定
Route::resource('users', UserController::class)->middleware('auth');

//itemsのルート設定
Route::resource('items', ItemController::class)->middleware('auth');

Route::controller(ItemController::class)->prefix('items')->name('items.')->middleware('auth')->group(function () {
  Route::post('import', 'import')->name('import');
  Route::get('all/items', 'getAllItems');
  Route::get('get/{item_id}', 'getItem');
});

//ordersのルート設定
Route::resource('orders', OrderController::class)->middleware('auth');
Route::controller(OrderController::class)->prefix('orders')->name('orders.')->group(function () {
  Route::post('confirm', 'confirm')->name('confirm');
});

//companiesのルート設定
Route::resource('companies', CompanyController::class)->middleware('auth');

//メールのルート設定
Route::controller(MailController::class)->group(function () {
  Route::get('/order-mail/{order_id}', 'orderMail')->name('orderMail');
});
