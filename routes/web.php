<?php

use Illuminate\Support\Facades\Route;
use App\Models\Store;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('stores/create', function () {
    return view('create_store');
});

Route::get('products/create', function () {
    $stores = Store::all();
    return view('create_product', compact('stores'));
});
