<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\HasilPemeriksaan;
use App\Models\JenisPemeriksaan;
use Illuminate\Support\Facades\Auth;

class RiwayatUController extends Controller
{
    public function index()
    {
        $pemeriksaan = Pemeriksaan::join('users', 'pemeriksaans.user_id', '=', 'users.id')
            ->where('user_id', '=', Auth::user()->id)
            ->where('selesai', '=', 0)
            ->orderByDesc('pemeriksaans.created_at')
            ->orderByDesc('pemeriksaans.status')
            ->get();

        // $pemeriksaan = JenisPemeriksaan::join('hasil_pemeriksaans', 'jenis_pemeriksaans.id', '=', 'hasil_pemeriksaans.jenis_id')
        //     ->join('pemeriksaans', 'hasil_pemeriksaans.pemeriksaan_id', '=', 'pemeriksaans.id')
        //     ->where('pemeriksaans.user_id', '=', Auth::user()->id)
        //     ->get();

        // dd(json_decode($pemeriksaan));
        $selesai = Pemeriksaan::where('user_id', '=', Auth::user()->id)
            ->join('users', 'pemeriksaans.user_id', '=', 'users.id')
            ->where('selesai', '=', 1)
            ->orderByDesc('pemeriksaans.created_at')
            ->select(['*', 'pemeriksaans.id as periksa_id'])
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

        $result->age = Carbon::parse($result->birth)->age;

        $hasil = JenisPemeriksaan::join('hasil_pemeriksaans', 'jenis_pemeriksaans.id', '=', 'hasil_pemeriksaans.jenis_id')
            ->join('pemeriksaans', 'hasil_pemeriksaans.pemeriksaan_id', '=', 'pemeriksaans.id')
            ->where('pemeriksaans.id', '=', $id)
            ->get();

        $hasil = HasilPemeriksaan::where('pemeriksaan_id', '=', $id)
            ->get();

        $data = [
            'id' => 0,
            'hasil' => 'ok',
            'name' => 'name',
            'sub' => [
                'id' => 0,
                'hasil' => 'ok',
                'name' => 'name',
                'sub2' => [
                    'id' => 0,
                    'hasil' => 'ok',
                    'name' => 'name'
                ]
            ]
        ];

        $data = [];
        foreach ($hasil as $key => $value) {
            if (!isset($value->sub_jenis_id) && !isset($value->sub_2_jenis_id)) {
                array_push($data, [
                    'id' => $value->id,
                ]);
            }
        }

        $pdf = Pdf::loadView('user.pdf.hasil_medical', [
            'result' => $result,
            'hasil' => $hasil
        ]);
        return response()->json([
            'result' => $result,
            'hasil' => $hasil
        ]);

        return view('user.pdf.hasil_medical', [
            'result' => $result,
            'hasil' => $hasil
        ]);

        return $pdf->download("Hasil MCU_{$result->name}_{$result->tanggal}.pdf");
    }
}
