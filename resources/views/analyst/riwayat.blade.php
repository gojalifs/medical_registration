@extends('index')

@section('dash-content')
    <div>
        <div class="text-xl mb-4">Data Registrasi Medical Pasien Baru</div>
        <table>
            <thead>
                <th class="border px-4 py-2">No.</th>
                <th class="border px-4 py-2">Tanggal Pemeriksaan</th>
                <th class="border px-4 py-2">Nama Pasien</th>
                <th class="border px-4 py-2">Nomor Telp.</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Aksi</th>
            </thead>
            <tbody>
                @foreach ($pemeriksaan as $key => $p)
                    <tr>
                        <td class="border px-4 py-2">{{ $key + 1 }}</td>
                        <td class="border px-4 py-2">{{ $p->tanggal }}</td>
                        <td class="border px-4 py-2">{{ $p->name }}</td>
                        <td class="border px-4 py-2">{{ $p->phone }}</td>
                        <td class="border px-4 py-2">{{ $p->selesai == 1 ? 'Sudah Selesai' : 'Belum Selesai' }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('input_hasil', ['id' => $p->pemeriksaan_id]) }}"
                                class="bg-green-400 hover:bg-green-500 hover:text-white px-4 py-2">Input Hasil
                                Pemeriksaan</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr class="my-8">

        <div class="text-xl my-4">Data Medical Sudah Selesai</div>
        <table>
            <thead>
                <th class="border px-4 py-2">No.</th>
                <th class="border px-4 py-2">Tanggal Pemeriksaan</th>
                <th class="border px-4 py-2">Nama Pasien</th>
                <th class="border px-4 py-2">Nomor Telp.</th>
                <th class="border px-4 py-2">Status</th>
            </thead>
            <tbody>
                @foreach ($selesai as $key => $s)
                    <tr>
                        <td class="border px-4 py-2">{{ $key + 1 }}</td>
                        <td class="border px-4 py-2">{{ $s->tanggal }}</td>
                        <td class="border px-4 py-2">{{ $s->name }}</td>
                        <td class="border px-4 py-2">{{ $s->phone }}</td>
                        <td class="border px-4 py-2">{{ $s->selesai == 1 ? 'Sudah Selesai' : 'Belum Selesai' }}</td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
