<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartJSController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SickController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('stats', [ChartJSController::class, 'index'])->name('stats');
    Route::resource('sick', SickController::class);
    Route::resource('schedule', ScheduleController::class);
    Route::resource('categories', CategoryController::class);
    Route::post('/upload/image', [ImageController::class, 'upload'])->name('upload.image');
});
