<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AmenityController;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/accommodation', [AccommodationController::class, "display"]);
Route::get('/accommodation/create', [AccommodationController::class, 'create']);
Route::post('/accommodation', [AccommodationController::class, 'store']);
Route::get('/accommodation/{id}/edit', [AccommodationController::class, 'edit']);
Route::put('/accommodation/{id}', [AccommodationController::class, 'update']);
Route::delete('/accommodation/{id}', [AccommodationController::class, 'destroy']);

Route::get('/amenities/index', [AmenityController::class, 'index'])->name('amenities.index');
Route::get('/amenities/create', [AmenityController::class, 'create'])->name('amenities.create');
Route::post('/amenities', [AmenityController::class, 'store'])->name('amenities.store');
Route::get('/amenities/{id}/edit', [AmenityController::class, 'edit'])->name('amenities.edit');
Route::put('/amenities/{id}', [AmenityController::class, 'update'])->name('amenities.update');
Route::delete('/amenities/{id}', [AmenityController::class, 'destroy'])->name('amenities.destroy');
