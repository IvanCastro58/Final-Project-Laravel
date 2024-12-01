<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccommodationController;

Route::get('/', [AccommodationController::class, "index"]);
Route::get('/accommodation', [AccommodationController::class, "display"]);
Route::get('/accommodation/create', [AccommodationController::class, 'create']);
Route::post('/accommodation', [AccommodationController::class, 'store']);
Route::get('/accommodation/{id}/edit', [AccommodationController::class, 'edit']);
Route::put('/accommodation/{id}', [AccommodationController::class, 'update']);
Route::delete('/accommodation/{id}', [AccommodationController::class, 'destroy']);
