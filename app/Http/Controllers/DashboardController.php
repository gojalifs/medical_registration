<?php

namespace App\Http\Controllers;

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

        return view('user.dashboard', [
            'sidebar' => $this->menu,
        ]);
    }
}
