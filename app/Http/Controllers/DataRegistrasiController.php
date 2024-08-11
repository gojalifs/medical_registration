<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Log;

class DataRegistrasiController extends Controller
{
    public function index(): View
    {

        $user = User::join('pemeriksaans', 'users.id', '=', 'pemeriksaans.user_id')
            ->where('role', '=', 'USER')
            ->where('selesai', '=', 0)
            ->select(['*', 'pemeriksaans.id as pemeriksaan_id'])
            ->paginate(10);
        foreach ($user as $value) {
            $value->tanggal = Carbon::parse($value->tanggal)->translatedFormat('d F Y');
            $value->birth = Carbon::parse($value->birth)->translatedFormat('d F Y');
        }

        $analis = User::where('role', '=', 'ANALYST')->get();

        return view('admin.data-registrasi', [
            'sidebar' => $this->menu,
            'data' => $user,
            'analyst' => $analis
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $analyst = $request->pemeriksa;
        $registrasi = Pemeriksaan::find($request->id);
        $registrasi->analyst_id = $analyst;
        $registrasi->save();

        return redirect()->back()->with('success', 'Sukses mengubah petugas analis.');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->birth = $request->birth;
            $user->role = 'USER';
            $user->password = Hash::make($request->password);

            $user->save();

            return redirect()->back()->with('success', 'Sukses menambah master data pengguna.');
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi.']);
        }
    }

    // public function update(Request $request): RedirectResponse
    // {
    //     try {
    //         $user = User::find($request->id);
    //         $user->name = $request->name;
    //         $user->email = $request->email;
    //         $user->phone = $request->phone;
    //         $user->gender = $request->gender;
    //         $user->birth = $request->birth;

    //         $user->save();

    //         return redirect()->back()->with('success', 'Sukses mengubah data pengguna.');
    //     } catch (Exception $e) {
    //         Log::debug($e->getMessage());
    //         return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi.']);
    //     }
    // }

    public function destroy($id): RedirectResponse
    {
        try {
            $result = DB::table('users')->where('id', '=', $id)->delete();

            if ($result > 0) {
                return redirect()->back()->with('success', 'Sukses menghapus data pengguna.');
            } else {
                return redirect()->back()->withErrors('message', 'erjadi kesalahan. Gagal menyimpan, silahkan ulangi.');
            }

        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi.']);
        }
    }

}
