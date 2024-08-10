<?php

use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\RegistrasiMCUController;
use App\Http\Controllers\RiwayatUController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnalisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataRegistrasiController;
use App\Http\Controllers\JenisPemeriksaanController;

Route::get('/login', [AuthController::class, 'index'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.do');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registrasi', [AuthController::class, 'showRegis'])->name('regis.index');
Route::post('/registrasi', [AuthController::class, 'store'])->name('regis.store');

Route::middleware('authenticate')->group(function () {

    /// Middleware untuk admin
    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        Route::get('/dashboard-admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

        Route::get('/jenis-pemeriksaan', [JenisPemeriksaanController::class, 'index'])->name('admin.jenis');
        Route::post('/jenis-pemeriksaan', [JenisPemeriksaanController::class, 'store'])->name('admin.jenis.save');
        Route::post('/jenis-pemeriksaan/update', [JenisPemeriksaanController::class, 'update'])->name('admin.jenis.update');
        Route::post('/jenis-pemeriksaan/delete', [JenisPemeriksaanController::class, 'destroy'])->name('admin.jenis.delete');

        Route::get('/data-analis', [AnalisController::class, 'index'])->name('admin.analis');
        Route::post('/data-analis', [AnalisController::class, 'store'])->name('admin.analis.save');
        Route::post('/data-analis/update', [AnalisController::class, 'update'])->name('admin.analis.update');
        Route::post('/data-analis/{id}', [AnalisController::class, 'destroy'])->name('admin.analis.delete');


        Route::get('/data-pasien', [DataRegistrasiController::class, 'index'])->name('admin.pasien');
    });

    Route::middleware('analyst')->group(function () {
        Route::get('/dashboard-analis', [DashboardController::class, 'analystDashboard'])->name('analyst.dashboard');
        Route::get('/pemeriksaan', [PemeriksaanController::class, 'indexAnalyst'])->name('analyst.pemeriksaan');
        Route::get('/pemeriksaan/{id}', [PemeriksaanController::class, 'showEdit'])->name('input_hasil');
        Route::post('/pemeriksaan', [PemeriksaanController::class, 'saveHasil'])->name('analyst.pemeriksaan.save');

    });

    Route::middleware('user')->group(function () {
        Route::get('/dashboard-user', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
        Route::get('/pedaftaran', [RegistrasiMCUController::class, 'index'])->name('user.regis');
        Route::post('/pedaftaran', [RegistrasiMCUController::class, 'store'])->name('user.regis.store');
        Route::get('/riwayat', [RiwayatUController::class, 'index'])->name('user.pemeriksaan');
        Route::get('/generate_pdf/{id}', [RiwayatUController::class, 'pdf'])->name('generate_pdf');

    });
});
