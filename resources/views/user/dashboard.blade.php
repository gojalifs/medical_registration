@extends('index')

@section('dash-content')
    <div class="text-center space-y-12">
        {{-- Counter --}}
        <div class="text-5xl mt-8">
            Selamat datang di website pendaftaran Medical Checkup.
        </div>
        <div class="text-3xl">
            Untuk Memulai, silahkan pilih menu di samping
        </div>
        <hr>
        <div class="text-left">
            <div class="text-left text-xl mb-6">Riwayat Medical Checkup Terbaru Anda:</div>
            @if (isset($terbaru))
            <div class="max-w-lg space-y-4 pl-4 text-slate-800">
                <div class="flex justify-between">
                    <div>Nama</div>
                    <div>{{ Auth::user()->name }}</div>
                </div>
                <div class="flex justify-between">
                    <div>Tanggal</div>
                    <div>{{ $terbaru->tanggal ?: '' }}</div>
                </div>
                <div class="flex justify-between">
                    <div>Dokter Pemeriksa</div>
                    <div class="underline underline-offset-4">Dr. {{ $terbaru->name ?: '-' }}</div>
                </div>
                <div class="flex justify-between">
                    <div>Status</div>
                    <div>{{ $terbaru->selesai ? 'Sudah Selesai' : 'Belum Selesai' }}</div>
                </div>
            </div>                
            @else
                <div>Tidak ada data</div>
            @endif
        </div>
    </div>
@endsection
