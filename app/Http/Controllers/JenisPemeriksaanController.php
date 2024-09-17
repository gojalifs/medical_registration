<?php

namespace App\Http\Controllers;

use App\Models\JenisPemeriksaan;
use App\Models\Sub2JenisPemeriksaan;
use App\Models\SubJenisPemeriksaan;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Log;
use Session;

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

        return view('admin.jenis_pemeriksaan', [
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
        $jenis = JenisPemeriksaan::join('sub_jenis_pemeriksaans', 'jenis_pemeriksaans.id', '=', 'sub_jenis_pemeriksaans.jenis_pemeriksaan_id')
            ->get();
        // return json_encode($jenis);
        return view('admin.edit_jenis_pemeriksaan', [
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

    public function addSubTest(Request $request): JsonResponse
    {
        try {
            $subtest = new SubJenisPemeriksaan();

            $req = $request->json()->all();

            $subtest->jenis_pemeriksaan_id = $req['jenis_pemeriksaan_id'];
            $subtest->name = $req['name'];

            $subtest->save();

            return response()->json([
                'success' => true,
                'message' => 'Sukses menambah subtes pemeriksaan',
                'data' => $subtest
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error_code' => $e->getCode(),
                'message' => 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi.'
            ], 500);

        }
    }

    public function addSubTest2(Request $request): JsonResponse
    {
        try {
            $subtest = new Sub2JenisPemeriksaan();

            $req = $request->json()->all();

            $subtest->sub_jenis_pemeriksaan_id = $req['jenis_pemeriksaan_id'];
            $subtest->name = $req['name'];

            $subtest->save();

            return response()->json([
                'success' => true,
                'message' => 'Sukses menambah subtes pemeriksaan',
                'data' => $subtest,
            ], 201);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return response()->json([
                'success' => false,
                'error_code' => $e->getCode(),
                'message' => 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi.'
            ], 500);
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

    public function update_sub(Request $request): RedirectResponse
    {
        try {
            $jenisPemeriksaan = SubJenisPemeriksaan::find($request->id);
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
            $jenisPemeriksaan->sub_jenis_pemeriksaan_id = $request->sub_id;
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
            if (str_contains('1451', $e->getMessage())) {
                return redirect()->back()->withErrors(['message' => 'Gagal menghapus! Anda harus menghapus sub-sub terlebih dahulu!']);
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
