@extends('index')

@section('dash-content')
    <div class="text-center space-y-12">
        {{-- Counter --}}
        <div class="text-5xl">
            Selamat datang di website pendaftaran Medical Checkup.
        </div>
        <div class="text-3xl">
            Untuk Memulai, silahkan pilih menu di samping
        </div>
        <hr>
        <div class="text-left">
            <div class="text-left text-xl mb-6">Riwayat Medical Checkup Terbaru Anda:</div>
            <div class="max-w-lg space-y-4 pl-4 text-slate-800">
                <div class="flex justify-between">
                    <div>Nama</div>
                    <div>Lamine yamal</div>
                </div>
                <div class="flex justify-between">
                    <div>Tanggal</div>
                    <div>12 Juni 2024</div>
                </div>
                <div class="flex justify-between">
                    <div>Dokter Pemeriksa</div>
                    <div>Dr. Jaka</div>
                </div>
            </div>
        </div>
    </div>
@endsection
