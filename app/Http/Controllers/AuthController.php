<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Log;
use Password;

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
            $rules = [
                'name'      => 'required|alpha',
                'email'     => 'required|email|unique:users,email',
                'phone'     => 'required|numeric',
                'birth'     => 'required',
                'password'  => 'required|min:6',
            ];

            $request->validate($rules);

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

    public function reset(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPwd(Request $request): RedirectResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(rand());

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login.show')->with('success', __($status))
            : back()->withErrors(['error' => [__($status)]]);
    }
}
