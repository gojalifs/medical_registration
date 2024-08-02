<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPemeriksaanController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.do');

Route::middleware('authenticate')->group(function () {
    Route::get('/', [DashboardController::class, 'userDashboard'])->name('dashboard');

    /// Middleware untuk admin
    Route::middleware('admin')->group(function (){
        Route::get('/dashboard-admin', [DashboardController::class, 'userDashboard'])->name('admin.dashboard');
        Route::get('/jenis-pemeriksaan', [JenisPemeriksaanController::class, 'index'])->name('admin.jenis');
        Route::get('/ruangan', [JenisPemeriksaanController::class, 'index'])->name('admin.ruangan');
        Route::get('/data-pasien', [DashboardController::class, 'jenis'])->name('admin.pasien');
        Route::get('/data-analis', [DashboardController::class, 'jenis'])->name('admin.analis');        
    });

});
