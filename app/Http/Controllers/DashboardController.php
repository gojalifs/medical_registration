<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Summary of adminDashboard
     * @return \Illuminate\View\View
     */
    public function adminDashboard(): View
    {

        return view('admin.dashboard', [
            'sidebar' => $this->menu,
        ]);
    }

    /**
     * Summary of userDashboard
     * @return \Illuminate\View\View
     */
    public function userDashboard(): View
    {
        // $pemeriksaanTerbaru = 

        return view('user.dashboard', [
            'sidebar' => $this->menu,
            ''
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
