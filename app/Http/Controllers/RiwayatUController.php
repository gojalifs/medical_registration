<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatUController extends Controller
{
    public function index()
    {
        $pemeriksaan = Pemeriksaan::where('user_id', '=', Auth::user()->id)
            ->join('users', 'pemeriksaans.id', '=', 'users.id')
            ->get();

        return view('user.riwayat', [
            'sidebar' => $this->menu,
            'pemeriksaan' => $pemeriksaan
        ]);
    }
}
