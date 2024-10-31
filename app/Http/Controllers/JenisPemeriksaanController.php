<?php

namespace App\Http\Controllers;

use App\Models\JenisPemeriksaan;
use App\Models\Sub2JenisPemeriksaan;
use App\Models\SubJenisPemeriksaan;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class JenisPemeriksaanController extends Controller
{
    public function index()
    {

        $jenis = JenisPemeriksaan::all();
        // return json_encode($jenis);
        foreach ($jenis as $value) {
            $subJenis = SubJenisPemeriksaan::where('jenis_pemeriksaan_id', '=', $value->id)->get();
            foreach ($subJenis as $vs) {
                // return json_encode($vs);
                $sub2 = Sub2JenisPemeriksaan::where('sub_jenis_pemeriksaan_id', '=', $vs->id)->get();
                $vs->sub2 = $sub2;
            }
            $value->sub_jenis = $subJenis;
        }

        // return json_encode($jenis);

        return view('admin.jenis-pemeriksaan', [
            'sidebar' => $this->menu,
            'data' => $jenis,
            'success' => Session::get('success'),
        ]);
    }

    public function indexData(): JsonResponse
    {
        $jenis = JenisPemeriksaan::all();
        // return json_encode($jenis);
        foreach ($jenis as $value) {
            $subJenis = SubJenisPemeriksaan::where('jenis_pemeriksaan_id', '=', $value->id)->get();
            foreach ($subJenis as $vs) {
                // return json_encode($vs);
                $sub2 = Sub2JenisPemeriksaan::where('sub_jenis_pemeriksaan_id', '=', $vs->id)->get();
                $vs->sub2 = $sub2;
            }
            $value->sub_jenis = $subJenis;
        }

        return response()->json([
            'success' => true,
            'data' => $jenis
        ]);
    }

    public function detailJenisPemeriksaan($pemeriksaanId)
    // : View
    {
        $jenis = JenisPemeriksaan::with([
            'subJenisPemeriksaan' => function ($query) {
                $query->with('sub2JenisPemeriksaan');
            }
        ])
            ->where('jenis_pemeriksaans.id', '=', $pemeriksaanId)
            ->first();
        // return response()->json($jenis);
        // dd(json_decode($jenis, true));
        return view('admin.edit_jenis_pemeriksaan', [
            'sidebar' => $this->menu,
            'data' => json_decode($jenis, )
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

    public function addSubTest(Request $request): RedirectResponse
    {
        try {
            $subtest = new SubJenisPemeriksaan();

            $subtest->jenis_pemeriksaan_id = $request->jenis_id;
            $subtest->name = $request->name;

            $subtest->save();
            
            return redirect()->back()->with('success', 'Data berhasil disimpan!');
            
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['message'=> 'Data gagal disimpan!']);
        }
    }

    public function addSubTest2(Request $request): RedirectResponse
    {
        try {
            $subtest = new Sub2JenisPemeriksaan();

            $subtest->sub_jenis_pemeriksaan_id = $request->id;
            $subtest->name = $request->nama_pemeriksaan;

            $subtest->save();

            return redirect()->back()->with('success', 'Data berhasil disimpan!');

            // return response()->json([
            //     'success' => true,
            //     'message' => 'Sukses menambah subtes pemeriksaan',
            //     'data' => $subtest,
            // ], 201);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors(['message'=> 'Data gagal disimpan!']);

            // return response()->json([
            //     'success' => false,
            //     'error_code' => $e->getCode(),
            //     'message' => 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi.'
            // ], 500);
        }
    }

    public function update(Request $request): RedirectResponse
    {
        $jenisPemeriksaan = JenisPemeriksaan::find($request->id);
        $jenisPemeriksaan->nama_pemeriksaan = $request->nama_pemeriksaan;
        $jenisPemeriksaan->ruang = $request->room;

        $jenisPemeriksaan->save();

        return redirect()->back()->with('success', 'Sukses mengubah master data jenis pemeriksaan.');
    }

    public function update_sub(Request $request): RedirectResponse
    {
        try {
            $jenisPemeriksaan = SubJenisPemeriksaan::findOrFail($request->id);
            $jenisPemeriksaan->jenis_pemeriksaan_id = $request->jenis_id;
            $jenisPemeriksaan->name = $request->name;

            $jenisPemeriksaan->save();

            return redirect()->back()->with('success', 'Sukses mengubah master data jenis pemeriksaan.');
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi. Code: ' . $e->getCode()]);
        }
    }

    public function update_sub2(Request $request): RedirectResponse
    {
        try {
            $jenisPemeriksaan = Sub2JenisPemeriksaan::find($request->id);
            $jenisPemeriksaan->sub_jenis_pemeriksaan_id = $request->parent_id;
            $jenisPemeriksaan->name = $request->name;

            $jenisPemeriksaan->save();

            return redirect()->back()->with('success', 'Sukses mengubah master data jenis pemeriksaan.');
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi. Code: ' . $e->getCode()]);
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        try {
            $result = DB::table('jenis_pemeriksaans')->where('id', '=', $request->id)->delete();

            if ($result > 0) {
                return redirect()->back()->with('success', 'Sukses menghapus data jenis pemeriksaan.');
            } else {
                return redirect()->back()->withErrors('message', 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi.');
            }

        } catch (Exception $e) {
            Log::debug($e->getMessage());
            if (str_contains('1451', $e->getMessage())) {
                return redirect()->back()->withErrors(['message' => 'Gagal menghapus, silahkan ulangi. Code: ' . $e->getCode()]);
            }
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan. Data tes memiliki sub tes! Hapus semua subtes terlebih dahulu!']);
        }
    }

    public function destroy_sub(Request $request): RedirectResponse
    {
        try {
            $result = DB::table('sub_jenis_pemeriksaans')->where('id', '=', $request->id)->delete();

            if ($result > 0) {
                return redirect()->back()->with('success', 'Sukses menghapus data jenis pemeriksaan.');
            } else {
                return redirect()->back()->withErrors('message', 'erjadi kesalahan. Gagal menyimpan, silahkan ulangi.');
            }

        } catch (Exception $e) {
            Log::debug($e->getMessage());
            if ($e instanceof QueryException) {
                return redirect()->back()->withErrors(['message' => 'Gagal menghapus! Anda harus menghapus sub-sub terlebih dahulu dan pastikan sub tes ini belum pernah digunakan! Silahkan Ubah Nama']);
            }
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan. Gagal menghapus, silahkan ulangi. Code: ' . $e->getCode()]);
        }
    }

    public function destroy_sub2(Request $request): RedirectResponse
    {
        try {
            $result = DB::table('sub_2_jenis_pemeriksaans')->where('id', '=', $request->id)->delete();

            if ($result > 0) {
                return redirect()->back()->with('success', 'Sukses menghapus data jenis pemeriksaan.');
            } else {
                return redirect()->back()->withErrors('message', 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi.');
            }

        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan. Gagal menghapus, silahkan ulangi. Code: ' . $e->getCode()]);
        }
    }
}
