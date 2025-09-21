<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
// Client Routes
use App\Http\Controllers\Client\ClientController;



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [AdminProductController::class, 'index'])->name('products');
});


Route::prefix('client')->name('client.')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('dashboard');
});