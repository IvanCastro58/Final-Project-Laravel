<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/employee', [EmployeeController::class, "display"])->name('employee');

Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit.logs');

Route::get('/accommodation', [AccommodationController::class, "display"]);
Route::get('/accommodation/create', [AccommodationController::class, 'create']);
Route::post('/accommodation', [AccommodationController::class, 'store']);
Route::get('/accommodation/{id}/edit', [AccommodationController::class, 'edit']);
Route::put('/accommodation/{id}', [AccommodationController::class, 'update']);
Route::delete('/accommodation/{id}', [AccommodationController::class, 'destroy']);
