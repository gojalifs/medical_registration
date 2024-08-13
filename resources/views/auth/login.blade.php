@extends('app')

@section('content')
    <div class="flex flex-col items-center justify-center h-screen">
        <img src="/login-bg.jpeg" alt="" class="w-screen h-screen absolute top-0 -z-10 blur-md">
        <div class="sm:w-[600px] mx-auto border rounded-md px-8 py-3 bg-white space-y-4 shadow-lg">
            <div class="text-center text-xl">
                Login
            </div>
            <div>
                <form action="{{ route('login.do') }}" method="post" class="space-y-4">
                    @if (Session::get('success'))
                        {
                        <div class="text-green-400">
                            {{ Session::get('success') }}
                        </div>
                        }
                    @endif
                    @if ($errors->any())
                        <div class="text-red-400">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    @csrf
                    <div class="space-y-2">
                        <div>
                            <label for="email">Email</label>
                        </div>
                        <input type="email" name="email" id="email" placeholder="Masukkan email..." class="w-full"
                            required autofocus>
                    </div>
                    <div class="space-y-2">
                        <div>
                            <label for="password">Password</label>
                        </div>
                        <input type="password" name="password" id="password" placeholder="Masukkan password..."
                            class="w-full" required>
                    </div>
                    <div class="text-right">
                        <a href="" class="text-blue-600 hover:text-blue-500">Lupa kata sandi?</a>
                    </div>
                    <button type="submit" class="bg-blue-400 px-2 py-1 hover:bg-blue-500">Login</button>
                    <div>
                        <a href="{{ route('regis.index') }}" class="text-blue-600 hover:text-blue-500">Daftar Sebagai
                            Pasien</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
