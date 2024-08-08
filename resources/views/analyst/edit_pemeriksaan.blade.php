@extends('index')

@section('dash-content')
    <div class="max-w-[600px] mx-auto border rounded-xl px-8 py-4">
        <div class="text-center text-xl font-medium">Form Pengisian Hasil Medical Checkup</div>
        <hr class="my-4">
        <form action="{{ route('analyst.pemeriksaan.save') }}" method="post">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $pemeriksaan->periksa_id }}">
            <div class="grid grid-cols-2 gap-y-4">
                <div class="text-left text-gray-600">Nama</div>
                <div class="font-medium">: {{ $pemeriksaan->name }}</div>
                <div class="text-left text-gray-600">Tanggal</div>
                <div class="font-medium">: {{ $pemeriksaan->tanggal }}</div>
                <div class="text-left text-gray-600">Pemeriksaan</div>
                <div class="col-span-2 grid grid-cols-2 px-8  items-center">
                    @foreach ($periksa as $k => $p)
                        <div class="text-left text-gray-600">{{ $k }} {{ $p->nama_pemeriksaan }} </div>
                        <input type="text" name="jenis{{ $k }}" id="jenis" class="my-3"
                            placeholder="Masukkan hasil dan satuannya" required>
                    @endforeach
                </div>
            </div>
            <div>
                <label for=""></label>
            </div>
            <div class="text-center">
                <button type="submit" class="text-center mt-4 px-3 py-1 bg-green-400 hover:bg-green-500">Simpan</button>
            </div>
        </form>
    </div>
@endsection
