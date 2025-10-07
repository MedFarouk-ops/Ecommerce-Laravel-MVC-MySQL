<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Middleware\RoleMiddleware;

// Default route → Client page (no auth required)
Route::get('/', [ClientController::class, 'index'])->name('client.home');
// Dashboard (only for logged in users)
Route::get('/dashboard', [ClientController::class, 'index'])->name('client.home');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Admin routes (only accessible by users with role 'admin')
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

     // Categories CRUD
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
   
    // Products
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/orders', function () {
        return view('Admin.orders.index');
    })->name('orders');
});


// Client routes (all prefixed with 'client' and named 'client.*')
Route::prefix('client')->name('client.')->middleware(['auth'])->group(function () {
    Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [ClientController::class, 'orders'])->name('orders');
});

// Routes that are public (no login required)
Route::prefix('client')->name('client.')->group(function () {
    // Dashboard / Products list
    Route::get('/dashboard', [ClientController::class, 'index'])->name('dashboard');
    // Product show page
    Route::get('/product/{product}', [ClientController::class, 'show_product'])->name('product.show');
     // Cart page
    Route::get('/cart', [ClientController::class, 'cart'])->name('cart');
});

// Laravel auth routes
require __DIR__.'/auth.php';
