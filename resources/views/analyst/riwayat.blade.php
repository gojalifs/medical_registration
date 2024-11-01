@extends('index')

@section('dash-content')
    <div>
        <div class="text-xl mb-4">Data Registrasi Medical Pasien Baru</div>
        <div class="relative overflow-x-auto rounded-lg">
            <table class="table-auto w-full mt-2 border-collapse h-[1px]">
                <thead class="bg-teal-200">
                    <th class="border px-4 py-2">No.</th>
                    <th class="border px-4 py-2">Tanggal Pemeriksaan</th>
                    <th class="border px-4 py-2">Nama Pasien</th>
                    <th class="border px-4 py-2">Nomor Telp.</th>
                    <th class="border px-4 py-2">Email Pasien</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($pemeriksaan as $key => $p)
                    <tr class="even:bg-teal-50 border-b">
                            <td class="px-4 py-2">{{ $key + 1 }}</td>
                            <td class="px-4 py-2">{{ $p->tanggal }}</td>
                            <td class="px-4 py-2">{{ $p->name }}</td>
                            <td class="px-4 py-2">{{ $s->email }}</td>
                            <td class="px-4 py-2">{{ $p->phone }}</td>
                            <td class="px-4 py-2">{{ $p->selesai == 1 ? 'Sudah Selesai' : 'Belum Selesai' }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('input_hasil', ['id' => $p->pemeriksaan_id]) }}"
                                    class="bg-green-400 hover:bg-green-500 hover:text-white px-4 py-2">Input Hasil
                                    Pemeriksaan</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr class="my-8">

        <div class="flex">
            <div class="text-xl w-full">Data Medical Sudah Selesai</div>
            <div>
                <form action="" method="get" class="flex float-end items-center">
                    <input type="text" name="search" id="search"
                        class="w-64 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg mr-4
                            focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-600 
                            dark:border-gray-500 dark:placeholder-gray-400 dark:text-white 
                            dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Cari Nama/Nomor Telp." value="{{ app('request')->input('search') }}">
                    <button type="submit">
                        <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white hover:text-teal-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        <div class="relative overflow-x-auto rounded-lg">
            <table class="table-auto w-full mt-2 border-collapse h-[1px]">
                <thead class="bg-teal-200">
                    <th class="border px-4 py-2">No.</th>
                    <th class="border px-4 py-2">Tanggal Pemeriksaan</th>
                    <th class="border px-4 py-2">Nama Pasien</th>
                    <th class="border px-4 py-2">Nomor Telp.</th>
                    <th class="border px-4 py-2">Email Pasien</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($selesai as $key => $s)
                        <tr class="even:bg-teal-50 border-b">
                            <td class="px-4 py-2">{{ $key + 1 }}</td>
                            <td class="px-4 py-2">{{ $s->tanggal }}</td>
                            <td class="px-4 py-2">{{ $s->name }}</td>
                            <td class="px-4 py-2">{{ $s->phone }}</td>
                            <td class="px-4 py-2">{{ $s->email }}</td>
                            <td class="px-4 py-2">{{ $s->selesai == 1 ? 'Sudah Selesai' : 'Belum Selesai' }}</td>
                            <td class="px-4 py-2">
                                <span class="flex">
                                    <a href="{{ route('input_hasil', ['id' => $s->pemeriksaan_id]) }}"
                                        class="mx-3 px-4 py-1 bg-yellow-400 hover:bg-yellow-500 rounded-md">Edit</a>

                                    <form action="{{ route('hasil_delete') }}" method="post">
                                        <input type="hidden" name="id" id="id"
                                            value="{{ $s->pemeriksaan_id }}">
                                        @csrf
                                        <button class="mx-3 px-4 py-1 bg-red-600 hover:bg-red-700 rounded-md">Hapus</button>
                                    </form>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
