<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductVariantController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/login', function () {
    return view('login');
})->name('login.page');

Route::post('/auth/register', [AuthController::class, 'register'])->name('register');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name("dashboard");

Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('/product_management', [ProductController::class, 'index'])->name('products');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

// Route to display the variant form (GET request)
Route::get('/products/{productId}/variants/create', [ProductController::class, 'showProductForm'])
    ->name('product.variants.create');

// Route to handle form submission (POST request)
Route::post('/products/{productId}/variants', [ProductController::class, 'storeVariant'])
    ->name('store.variant');

// Product Variants
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


Route::get('/customers', function () {
    return view('customers');
})->name('customers');


Route::get('/orders', [OrderController::class, 'index'])->name('orders');

Route::get('/payment', function () {
    return view('payment');
})->name('payment');

Route::get('/cms', function () {
    return view('cms');
})->name('cms');

Route::get('categories/create', [CategoriesController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoriesController::class, 'store'])->name('categories.store');

Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus']);
Route::post('/orders/{order}/cancel', [OrderController::class, 'cancelOrder']);
Route::post('/orders/{order}/refund', [OrderController::class, 'processRefund']);