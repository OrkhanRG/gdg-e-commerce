<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Front\CardController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
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
Route::prefix('admin')->middleware(['auth', 'user-role-check'])->name('admin.')->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    //category
    Route::resource('/category', CategoryController::class);
    Route::post('/category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');

    //brand
    Route::prefix('/brand')->name('brand.')->group(function (){

        Route::get('/', [BrandController::class, 'index'])->name('index');

        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::post('/create', [BrandController::class, 'store'])->name('store');

        Route::get('/update/{brand}', [BrandController::class, 'edit'])->name('edit');
        Route::put('/update/{brand}', [BrandController::class, 'update'])->name('update');

        Route::delete('/delete/{brand}', [BrandController::class, 'delete'])->name('delete');

        Route::post('/brand/change-status', [BrandController::class, 'changeStatus'])->name('change-status');
        Route::post('/brand/change-is-featured', [BrandController::class, 'changeIsFeatured'])->name('change-is-featured');
    });

    Route::prefix('/product')->name('product.')->group(function (){

        Route::get('/', [AdminProductController::class, 'index'])->name('index');

        Route::get('/create', [AdminProductController::class, 'create'])->name('create');
        Route::post('/create', [AdminProductController::class, 'store'])->name('store');

        Route::get('/update/{product}', [AdminProductController::class, 'edit'])->name('edit');
        Route::put('/update/{product}', [AdminProductController::class, 'update'])->name('update');

        Route::delete('/delete/{product}', [AdminProductController::class, 'delete'])->name('delete');

//        Route::post('/product/change-status', [AdminProductController::class, 'changeStatus'])->name('change-status');
//        Route::post('/product/change-is-featured', [AdminProductController::class, 'changeIsFeatured'])->name('change-is-featured');
    });

    Route::group(['prefix' => 'ecommerce-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

//Auth
Route::middleware(['throttle:registration', 'guest'])->group(function (){
    Route::get('/qeydiyyat', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/qeydiyyat', [RegisterController::class, 'register']);
});

Route::middleware(['throttle:login', 'guest'])->group(function (){
    Route::get('/daxil-ol', [LoginController::class, 'showForm'])->name('login');
    Route::post('/daxil-ol', [LoginController::class, 'login']);
});

Route::get('/auth/{driver}', [LoginController::class, 'socialiteAuth'])->name('socialite-auth');
Route::get('/auth/{driver}/callback', [LoginController::class, 'socialiteAuthVerify'])->name('socialite-auth-verify');

Route::post('/cixis', [LoginController::class, 'logout'])->name('logout');

Route::get('/verify', [RegisterController::class, 'verifyMailForm'])->name('verify-mail');
Route::post('/verify', [RegisterController::class, 'verifyMail']);

Route::get('/testiq/{token}', [RegisterController::class, 'verify'])->name('register.verify');
