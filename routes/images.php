<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('/images', ImageController::class);
});
