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
                    'route' => route('dashboard'),
                    'icon' => 'svg/dashboard.svg'
                ],
                // (object) [
                //     'title' => 'Master Ruangan',
                //     'route' => route('admin.ruangan'),
                //     'icon' => 'svg/room.png'
                // ],
                (object) [
                    'title' => 'Master Jenis Pemeriksaan',
                    'route' => route('admin.jenis'),
                    'icon' => 'svg/master-pemeriksaan.svg'
                ],
                (object) [
                    'title' => 'Data Analis Kesehatan',
                    'route' => route('admin.analis'),
                    'icon' => 'svg/profile.svg'
                ],
                (object) [
                    'title' => 'Data Pasien',
                    'route' => route('admin.pasien'),
                    'icon' => 'svg/profile.svg'
                ],
            ];
        } else if (Auth::user()->role == 'ANALYST') {
            $this->menu = (object) [
                (object) [
                    'title' => 'Dashboard',
                    'route' => route('analyst.dashboard'),
                    'icon' => 'svg/dashboard.svg'
                ],
                (object) [
                    'title' => 'Data Pasien',
                    'route' => route('analyst.pasien'),
                    'icon' => 'svg/pasien.svg'
                ],
                (object) [
                    'title' => 'Data Pemeriksaan',
                    'route' => route('analyst.pemeriksaan'),
                    'icon' => 'svg/data-pemeriksaan.svg'
                ],
            ];
        } else {
            $this->menu = (object) [
                (object) [
                    'title' => 'Dashboard',
                    'route' => route('user.dashboard'),
                    'icon' => 'svg/dashboard.svg'
                ],
                (object) [
                    'title' => 'Registrasi',
                    'route' => route('user.regis'),
                    'icon' => 'svg/regis.svg'
                ],
                (object) [
                    'title' => 'Data Pemeriksaan',
                    'route' => route('user.pemeriksaan'),
                    'icon' => 'svg/data-pemeriksaan.svg'
                ],
            ];
        }

    }
}
