<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'showHomePage'])->name('welcome');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/accommodation/{accommodation_id}', [AccommodationController::class, 'show'])->name('accommodation.show');

Route::get('/reserve', [ReservationController::class, 'showReservationForm']);
Route::post('/reserve', [ReservationController::class, 'submitReservation'])->name('reservation.submit');
Route::post('/reservation/submit', [ReservationController::class, 'store'])->name('reservation.submit');



Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/employee', [EmployeeController::class, "display"])->name('employee');
Route::post('/send-invitation', [EmployeeController::class, 'sendInvitation'])->name('sendInvitation');
Route::get('/register/{token}', [EmployeeController::class, 'showRegistrationForm'])->name('registerForm');
Route::post('/register/{token}', [EmployeeController::class, 'registerAccount'])->name('registerAccount');

Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit.logs');

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
