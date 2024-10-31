<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\HasilPemeriksaan;
use App\Models\JenisPemeriksaan;
use App\Models\SubJenisPemeriksaan;
use App\Models\Sub2JenisPemeriksaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PemeriksaanController extends Controller
{
    public function indexAnalyst()
    {
        $hasilPemeriksaan = HasilPemeriksaan::where('analyst_id', '=', Auth::user()->id)->get();
        $pemeriksaan = Pemeriksaan::join('users', 'pemeriksaans.user_id', '=', 'users.id')
            ->where('selesai', '=', 0)
            ->where('analyst_id', '=', Auth::user()->id)
            ->select(['*', 'pemeriksaans.id as pemeriksaan_id'])
            ->get();

        $selesai = Pemeriksaan::join('users', 'pemeriksaans.user_id', '=', 'users.id')
            ->where('selesai', '=', 1)
            ->where('analyst_id', '=', Auth::user()->id)
            ->select(['*', 'pemeriksaans.id as pemeriksaan_id'])
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
            ->where('pemeriksaans.id', '=', $id)
            ->first();

        $periksa = JenisPemeriksaan::all();
        // return json_encode($jenis);
        foreach ($periksa as $value) {
            $subJenis = SubJenisPemeriksaan::where('jenis_pemeriksaan_id', '=', $value->id)->get();
            foreach ($subJenis as $vs) {
                // return json_encode($vs);
                $sub2 = Sub2JenisPemeriksaan::where('sub_jenis_pemeriksaan_id', '=', $vs->id)->get();
                $vs->sub2 = $sub2;
            }
            $value->sub_jenis = $subJenis;
        }

        return view('analyst.edit_pemeriksaan', [
            'sidebar' => $this->menu,
            'pemeriksaan' => $pemeriksaan,
            'periksa' => $periksa
        ]);
    }

    public function dataEdit($id): JsonResponse
    {
        try {

            $jenis = JenisPemeriksaan::all();
            // return json_encode($jenis);
            foreach ($jenis as $value) {
                // dd($value->id);
                $hasil = HasilPemeriksaan::where('pemeriksaan_id', $id)
                    ->where('jenis_id', $value->id)
                    ->select(['hasil', 'id as hasil_id'])
                    ->first();

                $value->result = $hasil != null ? $hasil->hasil : '';
                $value->hasil_id = $hasil != null ? $hasil->hasil_id : '';

                $subJenis = SubJenisPemeriksaan::where('jenis_pemeriksaan_id', '=', $value->id)->get();
                foreach ($subJenis as $vs) {
                    // return json_encode($vs);
                    $hasil = HasilPemeriksaan::where('pemeriksaan_id', $id)
                        ->where('sub_jenis_id', $vs->id)
                        ->select(['hasil', 'id as hasil_id'])
                        ->first();
                    // dd($hasil);
                    $vs->result = $hasil != null ? $hasil->hasil : '';
                    $vs->hasil_id = $hasil != null ? $hasil->hasil_id : '';

                    $sub2 = Sub2JenisPemeriksaan::where('sub_jenis_pemeriksaan_id', '=', $vs->id)->get();
                    foreach ($sub2 as $vs2) {
                        $hasil = HasilPemeriksaan::where('pemeriksaan_id', $id)
                            ->where('sub_2_jenis_id', $vs2->id)
                            ->select(['hasil', 'id as hasil_id'])
                            ->first();

                        $vs2->result = $hasil != null ? $hasil->hasil : '';
                        $vs2->hasil_id = $hasil != null ? $hasil->hasil_id : '';
                    }

                    $vs->sub2 = $sub2;
                }
                $value->sub_jenis = $subJenis;
            }

            return response()->json([
                'success' => true,
                'data' => $jenis
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'error' => $th->getMessage(),
                    'message' => 'Error happened.'
                ]
            );
        }
    }

    public function saveHasil(Request $request)
    {
        $body = $request->all();
        $data = [];

        DB::transaction(function () use (&$body, $request) {
            $analystId = Auth::user()->id;

            foreach ($body['data'] as $key => $value) {
                // Log::info($value);
                // if (isset($value['data'])) {
                /// set for parent pemerikskaan
                if (isset($value['hasil'])) {
                    // dd($value['hasil']);
                    $hasil = HasilPemeriksaan::findOrNew($value['hasil_id']);
                    // $hasil = new HasilPemeriksaan();
                    $hasil->pemeriksaan_id = $body['id'];
                    $hasil->hasil = $value['hasil'];
                    $hasil->analyst_id = $analystId;
                    $hasil->jenis_id = $value['id'];
                    $hasil->save();
                }
                // dd($value);

                foreach ($value['jenis'] as $key => $jenisData) {
                    // dd($jenisData);
                    if (isset($jenisData['hasil'])) {
                        // dd($value['hasil']);
                        $hasil = HasilPemeriksaan::findOrNew($jenisData['hasil_id']);
                        // $hasil = new HasilPemeriksaan();
                        $hasil->pemeriksaan_id = $body['id'];
                        $hasil->hasil = $jenisData['hasil'];
                        $hasil->analyst_id = $analystId;
                        $hasil->sub_jenis_id = $jenisData['id'];
                        $hasil->save();
                    }
                    if (isset($jenisData['sub_jenis'])) {
                        foreach ($jenisData['sub_jenis'] as $key => $subJenisData) {
                            if (isset($subJenisData['hasil'])) {

                                $hasil = HasilPemeriksaan::findOrNew($subJenisData['hasil_id']);
                                // $hasil = new HasilPemeriksaan();
                                $hasil->pemeriksaan_id = $body['id'];
                                $hasil->hasil = $subJenisData['hasil'];
                                $hasil->analyst_id = $analystId;
                                $hasil->sub_jenis_id = $jenisData['id'];
                                $hasil->sub_2_jenis_id = $subJenisData['id'];
                                // dd($hasil);
                                $hasil->save();
                            }
                        }
                    }
                }
                // }
                // if (str_contains($key, 'name')) {
                //     $hasil = new HasilPemeriksaan();
                //     $hasil->pemeriksaan_id = $body['id'];
                //     $hasil->analyst_id = $analystId;
                //     $hasil->hasil = $value;
                //     $hasil->jenis_id = $request->input("jenis_id{$key}");
                //     $hasil->keterangan = 'OK';
                //     $hasil->save();
                // }
                // $data['jenis'] = 
            }

            $pemeriksaan = Pemeriksaan::find($request->id);
            $pemeriksaan->selesai = 1;
            $pemeriksaan->status = 'SELESAI';
            $pemeriksaan->save();
        });

        return response()->json([
            'status' => 'success',
            'message' => 'data saved successfully'
        ], 201);

        // return response()->json($body);
        // $jenisPemeriksaan = JenisPemeriksaan::all();

        // foreach ($jenisPemeriksaan as $key => $value) {
        //     $hasil = new HasilPemeriksaan();
        //     $hasil->pemeriksaan_id = $request->id;
        //     $hasil->analyst_id = Auth::user()->id;
        //     $hasil->hasil = $request->input("jenis{$key}");
        //     $hasil->jenis_id = $request->input("jenis_id{$key}");
        //     $hasil->keterangan = 'OK';
        //     $hasil->save();
        // }

        // $pemeriksaan = Pemeriksaan::find($request->id);
        // $pemeriksaan->selesai = 1;
        // $pemeriksaan->status = 'SELESAI';
        // $pemeriksaan->save();

        // return redirect()->route('analyst.pemeriksaan')->with('success', 'Berhasil menyimpan data');
    }

    public function destroy(Request $request)
    {
        // try {
        DB::transaction(function () use ($request) {
            $pemeriksaan = Pemeriksaan::findOrFail($request->id);
            $pemeriksaan->delete();
            HasilPemeriksaan::where('pemeriksaan_id', $pemeriksaan->id)->delete();
        });
        return redirect()->route('analyst.pemeriksaan')->with('success', 'Sukses menghapus data');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('error', $th->getMessage());
        // }
    }
}
