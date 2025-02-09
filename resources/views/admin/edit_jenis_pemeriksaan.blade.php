@extends('index')

@section('dash-content')
    <div>
        <div>
            <form action="{{ route('admin.jenis.update') }}" method="POST" class="">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                <div class="flex items-center">
                    <div class="min-w-80"> Detail Pemeriksaan </div>
                    <input type="text" name="nama_pemeriksaan" id="nama_pemeriksaan"
                        class="italic font-bold border-0 border-b border-b-gray-300" value="{{ $data->nama_pemeriksaan }}">
                </div>
                <div class="flex mt-2 items-center">
                    <div class="min-w-80">Ruang </div>
                    <input type="text" name="room" id="room"
                        class="italic font-bold border-0 border-b border-b-gray-300" value="{{ $data->ruang }}">
                </div>
                <button type="submit" class="hidden"></button>
            </form>

            <div class="relative overflow-x-auto rounded-lg">
                <table class="table-auto w-full mt-8 border-collapse h-[1px]">
                    <thead class="bg-teal-200">
                        <th class="border px-2 py-1">No.</th>
                        <th class="border px-2 py-1">Nama Sub Pemeriksaan</th>
                        <th class="border px-2 py-1">Sub Pemeriksaan</th>
                        <th class="border px-2 py-1">Aksi</th>
                    </thead>
                    <tbody id="body_table">
                        @foreach ($data->sub_jenis_pemeriksaan as $key => $value)
                            <tr class="mb-4 even:bg-teal-50 border-y">
                                <td class="p-4 text-center align-top text-sm">{{ $key + 1 }}</td>
                                <td class="p-4 align-top">
                                    <form action="{{ route('admin.jenis.sub.update') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="jenis_id" id="jenis_id" value="{{ $data->id }}">
                                        <input type="hidden" name="id" id="id" value="{{ $value->id }}">
                                        <input type="text" name="name" id="name" class="input_default"
                                            value="{{ $value->name }}">
                                    </form>
                                </td>
                                <td class="p-4">
                                    <ul>
                                        @foreach ($value->sub2_jenis_pemeriksaan as $item)
                                            <li class="my-2">
                                                <div class="flex items-center align-middle">
                                                    <form action="{{ route('admin.jenis.sub2.update') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" id="id"
                                                            value="{{ $item->id }}">
                                                        <input type="hidden" name="parent_id" id="parent_id"
                                                            value="{{ $value->id }}">
                                                        <input type="text" name="name" id="name"
                                                            class="input_default" value="{{ $item->name }}">
                                                    </form>
                                                    <form action="{{ route('admin.jenis.sub2.delete') }}" method="post"
                                                        class="ml-3">
                                                        @csrf
                                                        <input type="hidden" name="id" id="id"
                                                            value="{{ $item->id }}">
                                                        <div class="align-middle text-center items-center flex">
                                                            <button class="text-red-400 hover:bg-red-600 hover:text-white">
                                                                <svg class="w-6 h-6 dark:text-white" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </li>
                                        @endforeach
                                        <li>
                                            <form action="{{ route('admin.jenis.addSubTes2') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" id="id"
                                                    value="{{ $value->id }}">
                                                <input type="text" name="nama_pemeriksaan" id="nama_pemeriksaan"
                                                    class="input_default"
                                                    placeholder="Ketik dan enter untuk kirim">
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                                <td class="align-top">
                                    <form action="{{ route('admin.jenis.sub.delete') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{ $value->id }}">
                                        <button class="px-3 py-1 my-2 bg-red-500 hover:bg-red-600 rounded-md text-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        <tr class="mb-4 even:bg-teal-50 border-y">
                            <td class="p-4 text-center align-top">{{ isset($key) ? $key + 2 : 1 }}</td>
                            <td class="p-4 align-top">
                                <form action="{{ route('admin.jenis.addSubTes') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="jenis_id" id="jenis_id" value="{{ $data->id }}">
                                    {{-- <input type="hidden" name="id" id="id" value="{{ $value->id }}"> --}}
                                    <input type="text" name="name" id="name" class="input_default"
                                        placeholder="Masukkan Jenis Pemeriksaan Baru">
                                </form>
                            </td>
                            <td class="p-4">
                                -
                            </td>
                            <td class="align-top">
                                -
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="fixed top-32 right-0 mr-10 pb-10">
        @if (Session::get('success'))
            <div id="toast-success"
                class="items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-teal-50 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
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

        @if ($errors->has('message'))
            <div id="toast-danger"
                class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-teal-50 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                    </svg>
                    <span class="sr-only">Error icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ $errors->first() }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-danger" aria-label="Close">
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

    <script>
        setTimeout(function() {
            $('#toast-success').fadeOut('fast');
            $('#toast-danger').fadeOut('fast');
        }, 3000); // <-- time in milliseconds

        $("#btn_add").click(function(params) {

        })
    </script>
@endsection
