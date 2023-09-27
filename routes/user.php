<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('users/export/', [UserController::class, 'export'])->name('users.export');
    Route::get('users', [UserController::class, 'edit'])->name('users.edit');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::resource('users', UserController::class);
});
