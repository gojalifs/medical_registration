@extends('index')

@section('dash-content')
    <div>
        <div class="flex justify-between">
            <div>Data Tim Analis</div>
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="flex bg-green-400 hover:bg-teal-300 px-3 py-1 text-sm rounded-md">
                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
                Tambah
            </button>
        </div>
        <div class="relative overflow-x-auto rounded-lg">
            <table class="table-auto w-full mt-8 border-collapse h-[1px]">
                <thead class="bg-teal-200">
                    <th class="border px-8 py-1">No.</th>
                    <th class="border px-8 py-1">Nama Analis</th>
                    <th class="border px-8 py-1">Email</th>
                    <th class="border px-8 py-1">No. HP</th>
                    <th class="border px-8 py-1">Jenis Kelamin</th>
                    <th class="border px-8 py-1">Tanggal Lahir</th>
                    <th class="border px-8 py-1">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($data as $key => $p)
                        <tr class="even:bg-teal-50 border-b">
                            <td class="border px-8 py-1">{{ $key + 1 }}</td>
                            <td class="border px-8 py-1">{{ $p->name }}</td>
                            <td class="border px-8 py-1">{{ $p->email }}</td>
                            <td class="border px-8 py-1">{{ $p->phone }}</td>
                            <td class="border px-8 py-1">{{ $p->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td class="border px-8 py-1">{{ $p->birth }}</td>
                            <td class="border px-3 py-2 flex space-x-4">
                                <button class="flex bg-green-400 rounded-sm px-2 py-1 hover:text-white group"
                                    data-modal-target="crud-modal{{ $key }}"
                                    data-modal-toggle="crud-modal{{ $key }}">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                            clip-rule="evenodd" />
                                        <path fill-rule="evenodd"
                                            d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Edit</button>
                                <form action="{{ route('admin.analis.delete', $p->id) }}" method="POST">
                                    @csrf
                                    <button
                                        class="flex bg-red-400 rounded-sm px-2 py-1 hover:bg-red-600 group hover:text-white">
                                        <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white group-hover:text-white"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Hapus</button>
                                </form>
                            </td class="border px-2 py-1">
                        </tr>

                        {{-- Edit Modal --}}
                        <div id="crud-modal{{ $key }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 min-w-[600px] max-h-full">
                                <!-- Modal content -->
                                <div class=" bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Ubah Master Data Tim Analis
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="crud-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form action="{{ route('admin.analis.update') }}" class="px-4 md:p-5 mx-8"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{ $p->id }}">
                                        <div class="grid gap-4 mb-4 grid-cols-2 mx-8">
                                            <div class="col-span-2">
                                                <label for="name"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                                    Analis
                                                    Kesehatan</label>
                                                <input type="text" name="name" id="name"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Ketikkan nama analis..." value="{{ $p->name }}"
                                                    required>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="room"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                                <input type="email" name="email" id="email"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Ketikkan email..." value="{{ $p->email }}" required>
                                            </div>
                                            <div class="col-span-2">
                                                <label
                                                    for="phone"class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
                                                    HP</label>
                                                <input type="text" name="phone" id="phone"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Masukkan No. HP..." value="{{ $p->phone }}"
                                                    required>
                                            </div>
                                            <div class="col-span-2">Jenis Kelamin</div>
                                            <div class="mb-4 col-span-2 space-y-2">
                                                <div>
                                                    <input type="radio" name="gender" id="male" value="male"
                                                        class="bg-gray-50 mr-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        {{ $p->gender == 'male' ? 'checked' : '' }} required>
                                                    <label for="male"
                                                        class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Laki-laki</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="gender" id="female" value="female"
                                                        class="bg-gray-50 mr-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                                                    focus:border-primary-600 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        {{ $p->gender == 'female' ? 'checked' : '' }}>
                                                    <label for="female"
                                                        class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Perempuan</label>
                                                </div>
                                            </div>
                                            <div class="col-span-2 flex justify-between">
                                                <label for="birth">Tanggal Lahir</label>
                                                <input type="date" name="birth"
                                                    class="bg-gray-50 mr-2 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                                focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    value="{{ $p->birth }}" required>
                                            </div>
                                            <div class="col-span-2">
                                                <label
                                                    for="password"class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata
                                                    Sandi Baru</label>
                                                <input type="password" name="password" id="password"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Buat password baru untuk Analis...">
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="mx-8 mb-4 text-white inline-flex items-center bg-teal-500 hover:bg-teal-600 hover:ring-teal-700
                                         focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                                          dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Simpan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Master Data Tim Analis
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('admin.analis.save') }}" class="p-4 md:p-5" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Analis
                                Kesehatan</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Ketikkan nama analis..." required>
                        </div>
                        <div class="col-span-2">
                            <label for="room"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Ketikkan email..." required>
                        </div>
                        <div class="col-span-2">
                            <label for="phone"class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
                                HP</label>
                            <input type="text" name="phone" id="phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukkan No. HP..." required>
                        </div>
                        <div class="col-span-2">Jenis Kelamin</div>
                        <div class="mb-4 col-span-2 space-y-2">
                            <div>
                                <input type="radio" name="gender" id="male" value="male"
                                    class="bg-gray-50 mr-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                                <label for="male"
                                    class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Laki-laki</label>
                            </div>
                            <div>
                                <input type="radio" name="gender" id="female" value="female"
                                    class="bg-gray-50 mr-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                                    focus:border-primary-600 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <label for="female"
                                    class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Perempuan</label>
                            </div>
                        </div>
                        <div class="col-span-2 flex justify-between">
                            <label for="birth">Tanggal Lahir</label>
                            <input type="date" name="birth"
                                class="bg-gray-50 mr-2 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="password"class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata
                                Sandi Baru</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Buat password baru untuk Analis..." required>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-teal-500 hover:bg-teal-600 hover:ring-teal-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Simpan
                    </button>
                </form>
            </div>
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
