<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Summary of adminDashboard
     * @return \Illuminate\View\View
     */
    public function adminDashboard(): View
    {
        $analyst = User::where('role', '=', 'ANALYST')->count();
        $totalRegistrasi = Pemeriksaan::where('selesai', '=', 0)->count();

        return view('admin.dashboard', [
            'sidebar' => $this->menu,
            'analyst' => $analyst,
            'total_regist' => $totalRegistrasi
        ]);
    }

    /**
     * Summary of userDashboard
     * @return \Illuminate\View\View
     */
    public function userDashboard(): View
    {
        $pemeriksaanTerbaru = Pemeriksaan::where('user_id', '=', Auth::user()->id)
            ->join('users', 'analyst_id', '=', 'users.id')
            ->first();

        return view('user.dashboard', [
            'sidebar' => $this->menu,
            'terbaru' => $pemeriksaanTerbaru
        ]);
    }

    public function analystDashboard(): View
    {
        $semua = Pemeriksaan::where('selesai', '=', 0)->count();
        $today = Carbon::now();
        // dd();
        $pemeriksaanTerbaru = Pemeriksaan::where('tanggal', '=', $today->format('Y-m-d'))
            ->count();

        return view('analyst.dashboard', [
            'sidebar' => $this->menu,
            'semua' => $semua,
            'terbaru' => $pemeriksaanTerbaru
        ]);
    }
}
