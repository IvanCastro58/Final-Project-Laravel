<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/employee', [EmployeeController::class, "display"])->name('employee');
Route::post('/send-invitation', [EmployeeController::class, 'sendInvitation'])->name('sendInvitation');
Route::get('/register/{token}', [EmployeeController::class, 'showRegistrationForm'])->name('registerForm');
Route::post('/register/{token}', [EmployeeController::class, 'registerAccount'])->name('registerAccount');

Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit.logs');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

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
