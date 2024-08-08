@extends('app')

@section('content')
    <div class="flex flex-col items-center justify-center h-screen w-screen">
        {{-- <div class="w-screen h-screen">
            <img src="klinik.webp" alt="" class="w-screen h-screen -z-10 opacity-75 object-fill">
        </div> --}}
        <div class="sm:w-[600px] mx-auto border rounded-md px-8 py-3 bg-white space-y-4 shadow-sm">
            <div class="text-center text-xl">
                REGISTRASI PASIEN BARU
            </div>
            <div>
                <form action="{{ route('regis.store') }}" method="post" class="space-y-4">
                    @if ($errors->has('message'))
                    <div class="text-red-400">                        
                        {{ $errors->first() }}
                    </div>
                    @endif
                    @csrf
                    <div class="relative p-4 w-full max-h-full">
                        <!-- Modal body -->
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Pasien</label>
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
                                <label
                                    for="phone"class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
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
                                <label
                                    for="phone"class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata
                                    Sandi</label>
                                <input type="text" name="password" id="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Kata sandi..." required>
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
                            Daftar
                        </button>
                    </div>
                </form>
                <a href="/"
                    class="hover:text-white m-4 inline-flex items-center border border-teal-500 hover:bg-teal-600 hover:ring-teal-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Kembali ke Login
                </a>
            </div>
        </div>
    </div>
@endsection
