<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/product/{product}', [ProductController::class, 'showHome'])->name('product.showHome');
Route::get('/aanbiedingen', [ProductController::class, 'aanbiedingen'])->name('aanbiedingen');

Route::middleware(['auth'])->group(function () {
    Route::post('/products/remove-category', [ProductController::class, 'removeCategoryFromProduct'])->name('products.removeCategoryFromProduct');
    Route::post('/products/add-category', [ProductController::class, 'addCategoryFromProduct'])->name('products.addCategoryFromProduct');
    Route::resource('/products', ProductController::class);
});
