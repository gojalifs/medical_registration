<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.do');

Route::middleware('authenticate')->group(function () {
    Route::get('/', [DashboardController::class, 'userDashboard'])->name('dashboard');

    Route::get('/jenis-pemeriksaan', [DashboardController::class, 'jenis'])->name('admin.jenis');
    Route::get('/data-pasien', [DashboardController::class, 'jenis'])->name('admin.pasien');
});
