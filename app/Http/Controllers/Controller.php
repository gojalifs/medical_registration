<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected $menu;
    public function __construct()
    {
        if (!Auth::check()) {
            return;
        }

        if (Auth::user()->role == 'ADMIN') {
            $this->menu = (object) [
                (object) [
                    'title' => 'Dashboard',
                    'route' => 'admin.dashboard'
                ],
                (object) [
                    'title' => 'Master Jenis Pemeriksaan',
                    'route' => 'admin.jenis'
                ],
                (object) [
                    'title' => 'Data Pasien',
                    'route' => 'admin.pasien'
                ],
            ];
        } else if (Auth::user()->role == 'ANALYST') {
            $this->menu = (object) [
                (object) [
                    'title' => 'Dashboard',
                    'route' => 'analyst.dashboard'
                ],
                (object) [
                    'title' => 'Data Pasien',
                    'route' => 'analyst.pasien'
                ],
                (object) [
                    'title' => 'Data Pemeriksaan',
                    'route' => 'analyst.pemeriksaan'
                ],
            ];
        } else {
            $this->menu = (object) [
                (object) [
                    'title' => 'Dashboard',
                    'route' => 'user.dashboard'
                ],
                (object) [
                    'title' => 'Data Registrasi',
                    'route' => 'user.profile'
                ],
                (object) [
                    'title' => 'Data Pemeriksaan',
                    'route' => 'user.profile'
                ],
            ];
        }

    }
}
