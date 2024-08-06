<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Log;

class AnalisController extends Controller
{
    public function index(): View
    {

        $user = User::where('role', '=', 'ANALYST')
            ->paginate(10);

        return view('admin.data-analis', [
            'sidebar' => $this->menu,
            'data' => $user
        ]);
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
            $user->role = 'ANALYST';
            $user->password = Hash::make($request->password);

            $user->save();

            return redirect()->back()->with('success', 'Sukses menambah master data analis.');
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi.']);
        }
    }

    public function update(Request $request): RedirectResponse
    {
        try {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->birth = $request->birth;

            $user->save();

            return redirect()->back()->with('success', 'Sukses mengubah data analis.');
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi.']);
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $result = DB::table('users')->where('id', '=', $id)->delete();

            if($result > 0){
                return redirect()->back()->with('success', 'Sukses menghapus data analis.');
            }else{
                return redirect()->back()->withErrors('message', 'erjadi kesalahan. Gagal menyimpan, silahkan ulangi.');
            }

        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan. Gagal menyimpan, silahkan ulangi.']);
        }
    }

}
