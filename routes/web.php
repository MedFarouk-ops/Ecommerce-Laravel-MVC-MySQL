<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
// Client Routes
use App\Http\Controllers\Client\ClientController;

// Redirect root '/' to client dashboard
Route::get('/', function () {
    return redirect()->route('client.dashboard');
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories');
    Route::get('/products', [AdminProductController::class, 'index'])->name('products');

    // Admin Login
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    // You can add a POST route for login processing later
    // Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
});

// Client routes
Route::prefix('client')->name('client.')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('dashboard');
    Route::get('/cart', [ClientController::class, 'cart'])->name('cart');

    // Client Login & Registration
    Route::get('/login', [ClientController::class, 'showLogin'])->name('login');
    Route::get('/register', [ClientController::class, 'showRegister'])->name('register');
    // You can add POST routes for login/register processing later
    // Route::post('/login', [ClientController::class, 'login'])->name('login.submit');
    // Route::post('/register', [ClientController::class, 'register'])->name('register.submit');
});
