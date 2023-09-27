<?php

use App\Http\Controllers\ShoppingcartController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::patch('/shoppingcart', [ShoppingcartController::class, 'update'])->name('shoppingcart.update');
    Route::get('/geschiedenis/pdf/{id}', [ShoppingcartController::class, 'generatePDF'])->name('shoppingcart.generatePDF');
    Route::post('/add-to-cart', [ShoppingcartController::class, 'addToCart'])->name('shoppingcart.addToCart');
    Route::get('/empty-cart', [ShoppingcartController::class, 'emptyCart'])->name('shoppingcart.emptyCart');
    Route::get('/remove-from-cart/{id}', [ShoppingcartController::class, 'removeFromCart'])->name('shoppingcart.removeFromCart');
    Route::get('/shoppingcart/afronden', [ShoppingcartController::class, 'afronden'])->name('shoppingcart.afronden');
    Route::post('/shoppingcart/betalen', [ShoppingcartController::class, 'betalen'])->name('shoppingcart.betalen');
    Route::get('/geschiedenis', [ShoppingcartController::class, 'orderHistory'])->name('order_history');
    Route::get('/payed/{id}', [ShoppingcartController::class, 'payed'])->name('payed');
    Route::resource('shoppingcart', ShoppingcartController::class);
});
