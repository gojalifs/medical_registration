<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Log;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * Summary of login
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'email',
        ]);

        $attempt = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($attempt) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withErrors(['errors' => 'Login gagal. Periksa email dan kata sandi']);
        }
    }

    public function showRegis(): View
    {
        return view('auth.regis');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->birth = $request->birth;
            $user->role = 'USER';
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login.show')->with('success', 'Registrasi berhasil. Silahkan masuk');

        } catch (Exception $th) {
            Log::debug($th->getMessage());
            return redirect()->back()->withErrors(['message' => "Gagal registrasi. Msg: {$th->getMessage()}"]);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
