<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>Reset Password</title>
</head>

<body class="h-screen">
    <form action="{{ route('reset.now') }}" method="post" class="h-full">
        @csrf
        <div class="flex flex-col justify-center items-center h-full space-y-4">
            @if (Session::get('status'))
                {{ Session::get('status') }}
            @endif
            @if (Session::get('email') || Session::has('email'))
                {{ Session::get('email') }}
            @endif
            @if ($errors->has('error'))
                <ul class="text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <input type="hidden" name="token" id="token" required class="min-w-96" value="{{ $token }}">
            <input type="email" name="email" id="email" placeholder="Ketikkan email anda di sini..." required
                autofocus class="min-w-96">
            <input type="password" name="password" id="password" placeholder="Ketikkan kata sandi baru di sini..."
                required class="min-w-96">
            <input type="password" name="password_confirmation" id="password_confirmation"
                placeholder="Konfirmasi kata sandi baru di sini..." required class="min-w-96">
            <button type="submit" class="mt-8 bg-blue-700 text-white px-3 py-1 hover:bg-blue-800">Reset Kata
                Sandi</button>
        </div>
    </form>
</body>

</html>
