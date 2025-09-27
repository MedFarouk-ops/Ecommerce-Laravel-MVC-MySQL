<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\RoleMiddleware;

// Default route → Client page (no auth required)
Route::get('/', [ClientController::class, 'index'])->name('client.home');

// Dashboard (only for logged in users)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Admin routes (only accessible by users with role 'admin')
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/categories', function () {
        return view('Admin.categories.index');
    })->name('categories');
   
    Route::get('/products', function () {
        return view('Admin.products.index');
    })->name('products');

    Route::get('/orders', function () {
        return view('Admin.orders.index');
    })->name('orders');
});


// Client routes
Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
Route::get('/client/cart', [ClientController::class, 'cart'])->name('client.cart');

// Laravel auth routes
require __DIR__.'/auth.php';
