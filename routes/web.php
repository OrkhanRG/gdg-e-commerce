<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Front\CardController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;

/* ---Front--- */
Route::get('/', [FrontController::class, 'index'])->name('front.index');

Route::get('/sifarislerim', [OrderController::class, 'myOrders'])->name('my-orders');
Route::get('/sifarislerim/detal', [OrderController::class, 'myOrderDetail'])->name('my-orders.detail');

Route::get('/mehsullar', [ProductController::class, 'prodcuts'])->name('products');
Route::get('/mehsullar/detal', [ProductController::class, 'prodcutDetail'])->name('product.detail');

Route::get('/sebet', [CardController::class, 'card'])->name('card');

Route::get('/faktura', [CheckoutController::class, 'checkout'])->name('checkout');

/* ---Admin--- */
Route::prefix('admin')->name('admin.')->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('index');
});

//Auth
Route::get('/qeydiyyat', [RegisterController::class, 'showForm'])->name('register');
Route::post('/qeydiyyat', [RegisterController::class, 'register']);

Route::get('/daxil-ol', [LoginController::class, 'showForm'])->name('login');
Route::post('/daxil-ol', [LoginController::class, 'login']);
