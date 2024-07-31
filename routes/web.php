<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login.show');

Route::middleware('authenticate')->group(function () {
    Route::get('/', [DashboardController::class, 'userDashboard'])->name('dashboard');
});
