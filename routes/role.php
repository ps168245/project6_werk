<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::delete('roles/remove-user/{user}', [RoleController::class, 'removeUserFromRole'])->name('roles.removeUserFromRole');
    Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::post('roles/add-user/{user}', [RoleController::class, 'addUserToRole'])->name('roles.addUserToRole');
    Route::resource('roles', RoleController::class);
});
