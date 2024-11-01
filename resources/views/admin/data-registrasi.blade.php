@extends('index')

@section('dash-content')
    <div>Data Registrasi</div>
    <div class="w-full overflow-auto">
        <div class="relative overflow-x-auto rounded-lg">
            <table class="table-auto w-full mt-8 border-collapse h-[1px]">
                <thead class="bg-teal-200">
                    <th class="border px-8 py-1">No.</th>
                    <th class="border px-8 py-1">Nama Pasien</th>
                    <th class="border px-8 py-1">Email</th>
                    <th class="border px-8 py-1">No. HP</th>
                    <th class="border px-8 py-1">Jenis Kelamin</th>
                    <th class="border px-8 py-1">Tanggal Lahir</th>
                    <th class="border px-8 py-1">Tanggal Medical</th>
                    <th class="border px-8 py-1">Analis Pemeriksa</th>
                </thead>
                <tbody>
                    @foreach ($data as $key => $p)
                        <tr class="even:bg-teal-50 border-b">
                            <td class="border px-8 py-4">{{ $key + 1 }}</td>
                            <td class="border px-8 py-4">{{ $p->name }}</td>
                            <td class="border px-8 py-4">{{ $p->email }}</td>
                            <td class="border px-8 py-4">{{ $p->phone }}</td>
                            <td class="border px-8 py-4">{{ $p->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td class="border px-8 py-4">{{ $p->birth }}</td>
                            <td class="border px-8 py-4">{{ $p->tanggal }}</td>
                            <td class="border px-8 py-4">
                                <form action="{{ route('admin.set_analyst') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ $p->pemeriksaan_id }}">
                                    <select name="pemeriksa" id="pemeriksa{{ $p->id }}" onchange="this.form.submit()"
                                        class="border-none px-4">
                                        <option value="null" onclick="null">Belum Dipilih</option>
                                        @foreach ($analyst as $a)
                                            <option value="{{ $a->id }}"
                                                {{ $p->analyst_id == $a->id ? 'selected' : '' }}>{{ $a->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="fixed top-32 right-0 mr-10 pb-10">
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
            $('#toast-error').fadeOut('fast');
        }, 3000); // <-- time in milliseconds
    </script>
@endsection
