<?php

use App\Http\Controllers\KuinController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/kuin/menu', [KuinController::class, 'buttons'])->name('kuin.buttons');
    Route::get('/kuin/orders', [KuinController::class, 'orders'])->name('kuin.orders');
    Route::get('/kuin/orders/{id}', [KuinController::class, 'showOrder'])->name('kuin.showOrder');
    Route::resource('/kuin', KuinController::class);
});
