<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// Client
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientOrderController;

// Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminPromotionController;
use App\Http\Controllers\Admin\AdminWebsiteInfoController;

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
    
     // Search Routes
    Route::get('/products/search', [AdminProductController::class, 'search'])->name('products.search');
    Route::get('/categories/search', [AdminCategoryController::class, 'search'])->name('categories.search');
    Route::get('/orders/search', [AdminOrderController::class, 'search'])->name('orders.search');
    Route::get('/promotions/search', [AdminPromotionController::class, 'search'])->name('promotions.search');

    // Categories CRUD Management
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
   
    // Products CRUD Management
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    // Orders CRUD Management
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::get('orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit');
    Route::put('orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
    Route::delete('orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    // Promotion CRUD Management
    Route::get('promotions', [AdminPromotionController::class, 'index'])->name('promotions.index');
    Route::get('/promotions/create', [AdminPromotionController::class, 'create_promotion'])->name('promotions.create');
    Route::post('/promotions', [AdminPromotionController::class, 'store'])->name('promotions.store');
    Route::get('promotions/{promotion}', [AdminPromotionController::class, 'view_promotion'])->name('promotions.show');
    Route::get('promotions/{promotion}/edit', [AdminPromotionController::class, 'edit_promotion'])->name('promotions.edit');
    Route::put('promotions/{promotion}', [AdminPromotionController::class, 'update'])->name('promotions.update');
    Route::delete('promotions/{promotion}', [AdminPromotionController::class, 'destroy'])->name('promotions.destroy');

    // Website Information CRUDs
    Route::get('website-info/edit', [AdminWebsiteInfoController::class, 'edit'])->name('website-info.edit');
    Route::post('website-info/update', [AdminWebsiteInfoController::class, 'update'])->name('website-info.update');
   
});


// Client routes (private routes / need login)
Route::prefix('client')->name('client.')->middleware(['auth'])->group(function () {
    Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [ClientOrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [ClientOrderController::class, 'store'])->name('orders.store');
});

// Routes that are public (no login required) (accessible by users with role 'client')
Route::prefix('client')->name('client.')->group(function () {
    // Dashboard / Products list
    Route::get('/dashboard', [ClientController::class, 'index'])->name('dashboard');
    // Product show page
    Route::get('/product/{product}', [ClientController::class, 'show_product'])->name('product.show');
     // Cart page
    Route::get('/cart', [ClientController::class, 'cart'])->name('cart');
    Route::get('/search', [ClientController::class, 'search_product'])->name('search');
    Route::get('/products/category/{id}', [ClientController::class, 'getByCategory'])->name('products.byCategory');
});

// Laravel auth routes
require __DIR__.'/auth.php';
