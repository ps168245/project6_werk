<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::post('/default-address/{id}', [AddressController::class, 'setDefault'])->name('addresses.setDefault');
    Route::resource('addresses', AddressController::class);
});
