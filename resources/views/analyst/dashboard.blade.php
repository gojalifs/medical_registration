@extends('index')

@section('dash-content')
    <div>
        {{-- Counter --}}
        <div class="grid grid-cols-3 gap-4">
            <div class="h-32 rounded bg-gradient-to-r from-blue-500 to-cyan-400 p-4 shadow-md relative">
                <div class="text-6xl h-full text-right pr-10 font-bold">{{ $terbaru }}</div>
                <div class="text-white text-lg opacity-75 absolute bottom-0 left-0 p-2">
                    Total Periksa Hari Ini
                </div>
            </div>
            <div class="h-32 rounded bg-gradient-to-r from-blue-500 to-[#4fcfe3] p-4 shadow-md relative">
                <div class="text-6xl h-full text-right pr-10 font-bold">{{ $semua }}</div>
                <div class="text-white text-lg opacity-75 absolute bottom-0 left-0 p-2">
                    Total Pemeriksaan menunggu
                </div>
            </div>
        </div>
    </div>
@endsection
