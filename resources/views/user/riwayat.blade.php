@extends('index')

@section('dash-content')
    <div>
        <div>
            @if (Session::get('success'))
                <div id="toast-success"
                    class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-teal-50 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        <span class="sr-only">Check icon</span>
                    </div>
                    <div class="ms-3 text-sm font-normal">{{ Session::get('success') }}</div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                        data-dismiss-target="#toast-success" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>
        <div>
            <div class="text-xl mb-4">Data Medical Checkup Anda</div>
            <table>
                <thead>
                    <th class="border px-4 py-2">No.</th>
                    <th class="border px-4 py-2">Tanggal Pemeriksaan</th>
                    <th class="border px-4 py-2">Nama Pasien</th>
                    <th class="border px-4 py-2">Nomor Telp.</th>
                    <th class="border px-4 py-2">Status</th>
                </thead>
                <tbody>
                    @foreach ($pemeriksaan as $key => $p)
                        <tr>
                            <td class="border px-4 py-2">{{ $key + 1 }}</td>
                            <td class="border px-4 py-2">{{ $p->tanggal }}</td>
                            <td class="border px-4 py-2">{{ $p->name }}</td>
                            <td class="border px-4 py-2">{{ $p->phone }}</td>
                            <td class="border px-4 py-2">{{ $p->selesai == 1 ? 'Sudah Selesai' : 'Belum Selesai' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr class="my-8">

        <div>
            <div class="text-xl mb-4">Data Medical Checkup Sudah Selesai</div>
            <div class="relative overflow-x-auto rounded-lg">
                <table class="table-auto w-full mt-8 border-collapse h-[1px]">
                    <thead class="bg-teal-200">
                        <th class="border px-4 py-2">No.</th>
                        <th class="border px-4 py-2">Tanggal Pemeriksaan</th>
                        <th class="border px-4 py-2">Nama Pasien</th>
                        <th class="border px-4 py-2">Nomor Telp.</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($selesai as $key => $p)
                            <tr class="mb-4 even:bg-teal-50 border-y">
                                <td class="border px-4 py-2">{{ $key + 1 }}</td>
                                <td class="border px-4 py-2">{{ $p->tanggal }}</td>
                                <td class="border px-4 py-2">{{ $p->name }}</td>
                                <td class="border px-4 py-2">{{ $p->phone }}</td>
                                <td class="border px-4 py-2">{{ $p->selesai == 1 ? 'Sudah Selesai' : 'Belum Selesai' }}
                                </td>
                                <td class="border px-4 py-2">
                                    @if ($p->selesai == 1)
                                        <a href="{{ route('generate_pdf', $p->periksa_id) }}"
                                            class="bg-green-400 hover:bg-green-500 hover:text-white px-3 py-1 text-sm rounded-md">Download</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
