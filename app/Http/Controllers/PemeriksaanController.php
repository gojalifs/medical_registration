<?php

namespace App\Http\Controllers;

use App\Models\HasilPemeriksaan;
use App\Models\JenisPemeriksaan;
use App\Models\Pemeriksaan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeriksaanController extends Controller
{
    public function indexAnalyst()
    {
        $hasilPemeriksaan = HasilPemeriksaan::where('analyst_id', '=', Auth::user()->id)->get();
        $pemeriksaan = Pemeriksaan::where('selesai', '=', 0)
            ->join('users', 'pemeriksaans.id', '=', 'users.id')
            ->get();

        $selesai = Pemeriksaan::where('selesai', '=', 1)
            ->join('users', 'pemeriksaans.id', '=', 'users.id')
            ->get();

        // dd($selesai);

        return view('analyst.riwayat', [
            'sidebar' => $this->menu,
            'hasil' => $hasilPemeriksaan,
            'pemeriksaan' => $pemeriksaan,
            'selesai' => $selesai
        ]);
    }

    public function showEdit($id)
    {
        $pemeriksaan = Pemeriksaan::join('users', 'pemeriksaans.user_id', '=', 'users.id')
            ->select(['*', 'pemeriksaans.id as periksa_id'])
            ->first();

        $periksa = JenisPemeriksaan::all();
        // dd(json_decode(json_encode($periksa)));
        return view('analyst.edit_pemeriksaan', [
            'sidebar' => $this->menu,
            'pemeriksaan' => $pemeriksaan,
            'periksa' => $periksa
        ]);
    }

    public function saveHasil(Request $request): RedirectResponse
    {
        $jenisPemeriksaan = JenisPemeriksaan::all();

        foreach ($jenisPemeriksaan as $key => $value) {
            $hasil = new HasilPemeriksaan();
            $hasil->pemeriksaan_id = $request->id;
            $hasil->analyst_id = Auth::user()->id;
            $hasil->hasil = $request->input("jenis{$key}");
            $hasil->jenis_id = $request->input("jenis_id");
            $hasil->keterangan = 'OK';
            $hasil->save();
        }

        $pemeriksaan = Pemeriksaan::find($request->id);
        dd($request->id);
        $pemeriksaan->selesai = 1;
        $pemeriksaan->save();

        return redirect()->route('analyst.pemeriksaan')->with('success', 'Berhasil menyimpan data');
    }
}
