<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [FrontController::class, 'index'])->name('front.index');

Route::get('/sifarislerim', [OrderController::class, 'myOrders'])->name('my-orders');
Route::get('/sifarislerim/detal', [OrderController::class, 'myOrderDetail'])->name('my-orders.detail');

Route::get('/mehsullar', [ProductController::class, 'prodcuts'])->name('products');
Route::get('/mehsullar/detal', [ProductController::class, 'prodcutDetail'])->name('products');

Route::get('/sebet', [CardController::class, 'card'])->name('card');

Route::get('/faktura', [CheckoutController::class, 'checkout'])->name('checkout');
