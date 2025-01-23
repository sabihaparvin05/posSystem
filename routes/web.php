<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Salesman\SalesmanController;




Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//category routes
Route::get('/category-list', [CategoryController::class, 'list'])->name('categories.list');
Route::get('/add-category', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/add-category',[CategoryController::class, 'store' ])->name('categories.store');
Route::get('/categories/{slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{slug}/update', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');



//product routes
Route::get('/product-list', [ProductController::class, 'list'])->name('products.list');
Route::get('/add-product', [ProductController::class, 'create'])->name('products.create');
Route::post('/add-product',[ProductController::class, 'store' ])->name('products.store');
Route::get('/products/{slug}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/products/{slug}/update', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{slug}', [ProductController::class, 'destroy'])->name('products.destroy');

//purchase routes
Route::get('/purchase-list', [PurchaseController::class, 'purchaselist'])->name('purchase.list');
Route::get('/add-purchase', [PurchaseController::class, 'createPurchase'])->name('purchase.create');
Route::post('/add-purchase',[PurchaseController::class, 'storePurchase' ])->name('purchase.store');



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    // Additional admin routes
});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.dashboard');
    // Additional manager routes
});

Route::middleware(['auth', 'role:salesman'])->group(function () {
    Route::get('/salesman', [SalesmanController::class, 'index'])->name('salesman.dashboard');
    // Additional salesman routes
});


