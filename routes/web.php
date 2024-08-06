<?php

use App\Http\Controllers\AnalisController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPemeriksaanController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.do');

Route::middleware('authenticate')->group(function () {
    Route::get('/', [DashboardController::class, 'userDashboard'])->name('dashboard');

    /// Middleware untuk admin
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard-admin', [DashboardController::class, 'userDashboard'])->name('admin.dashboard');

        Route::get('/jenis-pemeriksaan', [JenisPemeriksaanController::class, 'index'])->name('admin.jenis');
        Route::post('/jenis-pemeriksaan', [JenisPemeriksaanController::class, 'store'])->name('admin.jenis.save');
        Route::post('/jenis-pemeriksaan/update', [JenisPemeriksaanController::class, 'update'])->name('admin.jenis.update');
        // Route::delete('/jenis-pemeriksaan/{id}', [JenisPemeriksaanController::class, 'destroy'])->name('admin.jenis.update');

        Route::get('/data-analis', [AnalisController::class, 'index'])->name('admin.analis');
        Route::post('/data-analis', [AnalisController::class, 'store'])->name('admin.analis.save');
        Route::post('/data-analis/update', [AnalisController::class, 'update'])->name('admin.analis.update');
        Route::post('/data-analis/{id}', [AnalisController::class, 'destroy'])->name('admin.analis.delete');

        Route::get('/data-pasien', [DashboardController::class, 'jenis'])->name('admin.pasien');
    });

});
