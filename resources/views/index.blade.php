@extends('app')

@section('content')
    <div>
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
            type="button"
            class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
            </svg>
        </button>

        <aside id="default-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
            aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                <div class="mt-8 mb-4">
                    <img src="svg/illustration.svg" alt="" class="size-12 sm:size-24 mx-auto">
                </div>
                <div class="text-center uppercase text-2xl">Medical Checkup</div>
                <hr class="my-6">
                <ul class="space-y-2 font-medium">
                    @foreach ($sidebar as $m)
                        <li class="{{ $m->route == URL::current() ? 'bg-teal-200' : '' }} hover:bg-teal-100">
                            <a href="{{ $m->route }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group">
                                <img src="{{ $m->icon }}" alt="" class="size-8">
                                <span class="ms-3">{{ $m->title }}</span>
                            </a>
                        </li>
                    @endforeach
                    <hr>
                    <li class="hover:bg-red-300">
                        <a href="" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group">
                            <img src="svg/logout.svg" alt="" class="size-8">
                            <span class="ms-3">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <div class="sm:ml-64 flex flex-col justify-between items-stretch h-screen p-4">
            <div>
                @include('layout.header')
                <div class="bg-white p-4 rounded-md shadow mt-4">
                    @yield('dash-content')
                </div>
            </div>
            @include('layout.footer')
        </div>
    </div>
@endsection
