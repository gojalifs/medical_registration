<?php

namespace App\Http\Controllers;

use App\Models\JenisPemeriksaan;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Log;

class JenisPemeriksaanController extends Controller
{
    public function index(): View
    {

        $jenis = JenisPemeriksaan::paginate(10);

        return view('admin.jenis_pemeriksaan', [
            'sidebar' => $this->menu,
            'data' => $jenis
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $jenisPemeriksaan = new JenisPemeriksaan();

            $jenisPemeriksaan->nama_pemeriksaan = $request->name;
            $jenisPemeriksaan->ruang = $request->room;

            $jenisPemeriksaan->save();

            return redirect()->back()->with('success', 'Sukses menambah master jenis pemeriksaan.');
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi.']);
        }
    }

    public function update(Request $request): RedirectResponse
    {
        $jenisPemeriksaan = JenisPemeriksaan::find($request->id);
        $jenisPemeriksaan->nama_pemeriksaan = $request->name;
        $jenisPemeriksaan->ruang = $request->room;

        $jenisPemeriksaan->save();

        return redirect()->back()->with('success', 'Sukses mengubah master data jenis pemeriksaan.');
    }
}
