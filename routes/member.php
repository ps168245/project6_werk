<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('members', [MemberController::class, 'edit'])->name('members.edit');
    Route::patch('members/{member}', [MemberController::class, 'update'])->name('member.update');
    Route::post('members/add-role/{user}', [MemberController::class, 'addUserToRole'])->name('members.addUserToRole');
    Route::delete('members/remove-role/{user}', [MemberController::class, 'removeUserFromRole'])->name('members.removeUserFromRole');
    Route::delete('members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
    Route::post('members/{user}', [MemberController::class, 'create'])->name('members.create');
    Route::resource('members', MemberController::class);
});
