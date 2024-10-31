<?php

use App\Http\Controllers\BannerController;
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

Route::get('/forgot', function () {
    return view('auth.forgot-password');
})->name('forgot');
Route::post('/send_reset', [AuthController::class, 'reset'])->name('send_reset_link');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset', ['token' => $token]);
})->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPwd'])->name('reset.now');

Route::middleware('authenticate')->group(function () {

    /// Banner Promo
    Route::get('/banner', [BannerController::class, 'data'])->name('admin.banner.data');
    Route::get('/jenis-pemeriksaan-index', [JenisPemeriksaanController::class, 'indexData'])->name('admin.jenis.data');

    /// Middleware untuk admin
    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        Route::get('/dashboard-admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

        Route::get('/jenis-pemeriksaan', [JenisPemeriksaanController::class, 'index'])->name('admin.jenis');
        Route::get('/detail_jenis-pemeriksaan/{id}', [JenisPemeriksaanController::class, 'detailjenisPemeriksaan'])->name('admin.jenis.detail');
        Route::post('/jenis-pemeriksaan', [JenisPemeriksaanController::class, 'store'])->name('admin.jenis.save');
        Route::post('add_sub_jenis_pemeriksaan', [JenisPemeriksaanController::class, 'addSubTest'])->name('admin.jenis.addSubTes');
        Route::post('add_sub_jenis_pemeriksaan2', [JenisPemeriksaanController::class, 'addSubTest2'])->name('admin.jenis.addSubTes2');
        Route::post('/jenis-pemeriksaan/update', [JenisPemeriksaanController::class, 'update'])->name('admin.jenis.update');
        Route::post('/jenis-pemeriksaan/update_sub', [JenisPemeriksaanController::class, 'update_sub'])->name('admin.jenis.sub.update');
        Route::post('/jenis-pemeriksaan/update_sub2', [JenisPemeriksaanController::class, 'update_sub2'])->name('admin.jenis.sub2.update');
        Route::post('/jenis-pemeriksaan/delete', [JenisPemeriksaanController::class, 'destroy'])->name('admin.jenis.delete');
        Route::post('/jenis-pemeriksaan/sub_delete', [JenisPemeriksaanController::class, 'destroy_sub'])->name('admin.jenis.sub.delete');
        Route::post('/jenis-pemeriksaan/sub2_delete', [JenisPemeriksaanController::class, 'destroy_sub2'])->name('admin.jenis.sub2.delete');

        Route::get('/data-analis', [AnalisController::class, 'index'])->name('admin.analis');
        Route::post('/data-analis', [AnalisController::class, 'store'])->name('admin.analis.save');
        Route::post('/data-analis/update', [AnalisController::class, 'update'])->name('admin.analis.update');
        Route::post('/data-analis/{id}', [AnalisController::class, 'destroy'])->name('admin.analis.delete');

        Route::get('/data-pasien', [DataRegistrasiController::class, 'index'])->name('admin.pasien');
        Route::post('/data-pasien', [DataRegistrasiController::class, 'update'])->name('admin.set_analyst');

        Route::get('/banners', [BannerController::class, 'index'])->name('admin.banner');
        Route::post('/banner', [BannerController::class, 'store'])->name('admin.banner.store');
        Route::post('/banner/delete', [BannerController::class, 'destroy'])->name('admin.banner.destroy');
    });

    Route::middleware('analyst')->group(function () {
        Route::get('/dashboard-analis', [DashboardController::class, 'analystDashboard'])->name('analyst.dashboard');
        Route::get('/pemeriksaan', [PemeriksaanController::class, 'indexAnalyst'])->name('analyst.pemeriksaan');
        Route::get('/pemeriksaan/{id}', [PemeriksaanController::class, 'showEdit'])->name('input_hasil');
        Route::get('/pemeriksaan_data_edit/{id}', [PemeriksaanController::class, 'dataEdit']);
        Route::post('/pemeriksaan', [PemeriksaanController::class, 'saveHasil'])->name('analyst.pemeriksaan.save');
        Route::post('/pemeriksaan_del', [PemeriksaanController::class, 'destroy'])->name('hasil_delete');
    });

    Route::middleware('user')->group(function () {
        Route::get('/dashboard-user', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
        Route::get('/pedaftaran', [RegistrasiMCUController::class, 'index'])->name('user.regis');
        Route::post('/pedaftaran', [RegistrasiMCUController::class, 'store'])->name('user.regis.store');
        Route::get('/riwayat', [RiwayatUController::class, 'index'])->name('user.pemeriksaan');
        Route::get('/generate_pdf/{id}', [RiwayatUController::class, 'pdf'])->name('generate_pdf');
    });
});
