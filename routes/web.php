<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\TeknisiAuth;
use App\Http\Controllers\DamageReportController;
use App\Http\Controllers\RepairActivityController;
use App\Http\Controllers\FacilityController;


// Login
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware('auth')->group(function() {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::middleware([AdminAuth::class])->group(function () {

        // new
        Route::resource('facility', FacilityController::class);

    });
    Route::middleware([TeknisiAuth::class])->group(function () {
        // Rute yang hanya dapat diakses oleh teknisi
        Route::resource('repairActivity', RepairActivityController::class);
        // Tambahkan rute lain yang ingin dilindungi di sini
    });
   
    Route::resource('damageReport', DamageReportController::class);
    Route::resource('repairActivity', RepairActivityController::class);
});