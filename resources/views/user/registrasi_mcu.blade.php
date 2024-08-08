@extends('index')

@section('dash-content')
    <div class="w-[600px] mx-auto">
        <div class="text-lg text-center">Registrasi MCU Di sini</div>
        <form action="{{ route('user.regis.store') }}" method="post" class="space-y-4 border rounded-md px-8 py-4 mt-4">
            @csrf
            <div class="flex justify-between">
                <div class="text-gray-700">Nama</div>
                <div>{{ $user->name }}</div>
            </div>
            <hr>
            <div class="flex justify-between">
                <div class="text-gray-700">Tanggal Lahir</div>
                <div>{{ $user->birth }}</div>
            </div>
            <hr>
            <div class="flex justify-between">
                <div class="text-gray-700">Email</div>
                <div>{{ $user->email }}</div>
            </div>
            <hr>
            <div class="flex justify-between">
                <div class="text-gray-700">Jenis Pemeriksaan</div>
                <div>
                    <ul class="text-right">
                        @foreach ($jenis as $j)
                            <li class="flex">
                                <svg class="w-6 h-6 pr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $j->nama_pemeriksaan }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <hr>
            <div class="flex justify-between">
                <div class="text-gray-700">Tanggal</div>
                <input type="date" name="date" class="border-gray-200" required>
            </div>
            <hr>
            <button type="submit" class="bg-teal-400 hover:bg-teal-500 hover:text-white px-4 py-2">Daftar Sekarang</button>
        </form>
    </div>
@endsection
