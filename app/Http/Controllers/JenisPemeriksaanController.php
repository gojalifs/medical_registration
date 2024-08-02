<?php

namespace App\Http\Controllers;

use App\Models\JenisPemeriksaan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JenisPemeriksaanController extends Controller
{
    public function index(): View{

        $jenis = JenisPemeriksaan::paginate(10);

        return view('admin.jenis_pemeriksaan', [
            'sidebar' => $this->menu,
            'data' => $jenis
        ]);
    }
}
