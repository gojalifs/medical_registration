<?php

namespace App\Http\Controllers;

use App\Models\HasilPemeriksaan;
use App\Models\JenisPemeriksaan;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatUController extends Controller
{
    public function index()
    {
        $pemeriksaan = Pemeriksaan::where('user_id', '=', Auth::user()->id)
            ->join('users', 'pemeriksaans.id', '=', 'users.id')
            ->where('selesai', '=', 0)
            ->orderByDesc('pemeriksaans.created_at')
            ->orderByDesc('pemeriksaans.status')
            ->get();

        $selesai = Pemeriksaan::where('user_id', '=', Auth::user()->id)
            ->join('users', 'pemeriksaans.id', '=', 'users.id')
            ->where('selesai', '=', 1)
            ->orderByDesc('pemeriksaans.created_at')
            ->get();

        return view('user.riwayat', [
            'sidebar' => $this->menu,
            'pemeriksaan' => $pemeriksaan,
            'selesai' => $selesai
        ]);
    }

    public function pdf($id)
    {
        $result = Pemeriksaan::join('users', 'pemeriksaans.user_id', '=', 'users.id')
            ->where('pemeriksaans.id', '=', $id)->first();

        $hasil = JenisPemeriksaan::join('hasil_pemeriksaans', 'jenis_pemeriksaans.id', '=', 'hasil_pemeriksaans.jenis_id')
            ->join('pemeriksaans', 'hasil_pemeriksaans.pemeriksaan_id', '=', 'pemeriksaans.id')
            ->where('pemeriksaans.id', '=', $id)
            ->get();

        return view('user.pdf.hasil_medical', [
            'result' => $result,
            'hasil' => $hasil
        ]);
    }
}
