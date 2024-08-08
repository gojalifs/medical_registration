<?php

namespace App\Http\Controllers;

use App\Models\JenisPemeriksaan;
use App\Models\Pemeriksaan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RegistrasiMCUController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $user = Auth::user();
        $pemeriksaan = JenisPemeriksaan::all();

        return view('user.registrasi_mcu', [
            'sidebar' => $this->menu,
            'user' => $user,
            'jenis' => $pemeriksaan
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $registrasi = new Pemeriksaan();
        $registrasi->user_id = Auth::user()->id;
        $registrasi->tanggal = $request->date;
        $registrasi->save();

        return redirect()->route('user.pemeriksaan')->with(['success' => 'Pendaftaran berhasil.']);
    }
}
