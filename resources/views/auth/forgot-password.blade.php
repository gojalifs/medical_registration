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
    <form action="{{ route('send_reset_link') }}" method="post" class="h-full">
        @csrf
        <div class="flex flex-col justify-center items-center h-full">
            @if (Session::get('status'))
                <div class="ps-4 py-2 text-sm font-normal text-green-500">{{ Session::get('status') }}</div>
            @endif
            @if ($errors->has('email'))
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="ps-4 py-2 text-sm font-normal text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <input type="email" name="email" id="email" placeholder="Ketikkan email di sini..." required
                autofocus class="min-w-96">
            <button type="submit" id="reset_btn"
                class="mt-8 bg-blue-700 text-white px-3 py-1 hover:bg-blue-800">
                Kirim link reset kata sandi
            </button>
            <a href="{{ route('login.show') }}" class="my-2 hover:text-blue-700 hover:underline">Kembali Ke Login</a>
        </div>
    </form>
</body>

</html>
