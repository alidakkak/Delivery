<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\RoleMiddleware;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('profile', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('stores', [StoreController::class, 'index']);
    Route::get('searchStore', [StoreController::class, 'searchStore']);
    Route::get('stores/{id}', [StoreController::class, 'show']);


    Route::get('products', [ProductController::class, 'index']);
    Route::get('searchProduct', [ProductController::class, 'searchProduct']);
    Route::get('products/{id}', [ProductController::class, 'show']);


    Route::post('addToCart', [CartController::class, 'addToCart']);
    Route::get('viewCart', [CartController::class, 'viewCart']);

    ///  Driver
    Route::post('switchStatus', [DriverController::class, 'switchStatus']);
    Route::get('orders', [DriverController::class, 'orders']);

    /// WishList
    Route::get('wishlist', [WishlistController::class, 'index']);
    Route::post('wishlist', [WishlistController::class, 'store']);
    Route::delete('wishlist/{id}', [WishlistController::class, 'delete']);
});

Route::middleware([RoleMiddleware::class])->group(function () {
    Route::post('stores', [StoreController::class, 'store']);

    Route::post('products', [ProductController::class, 'store']);
});
