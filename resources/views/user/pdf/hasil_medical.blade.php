<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hasil Medical Checkup</title>

    <style>
        .title {
            text-align: center;
            font-size: 24px;
            line-height: 28px;
        }

        table {
            width: 100%;
            margin-top: 1rem;
            border-collapse: collapse;
        }

        tr {
            text-align: center;
        }

        th,
        td {
            border: 5px solid rgb(107, 114, 128);
            border-width: 1px;
            --tw-border-opacity: 1;
            padding: 0.25rem 0.5rem;
        }
    </style>

</head>

<body>
    <div>
        <div>
            <img src="{{asset('/klinik_logo.webp')}}" alt=""
                style="float: left; margin-right: 16px; height: 100px; width: auto;">
            <div style="height: 100px; align-items: center">
                <div style="font-size: 24px; line-height: 32px; font-weight: 500; width: auto;">
                    Klinik dan Rumah Bersalin Kenanga
                </div>
                <div style="font-size: 18px; line-height: 28px; height: 24px;">
                    {{-- Tiara Vita, S.H., M.Kn. --}}
                </div>
                <div style="margin-bottom: 8px">Jl. Tegal Gede No.77, Pasirsari, Cikarang Selatan, kabupaten Bekasi, Jawa
                    Barat 17530
                </div>
                <div>Telp : (021) 8935937</div>
            </div>
        </div>
        <hr style="background-color: black; height: 0.25rem; margin-top: 1rem; margin-bottom: 1rem;">
        <div class="title">
            Hasil Medical Checkup
        </div>
        <div style="margin: 0 48px;">
            <div style="display: flex; margin: 16px 0;">
                <div style="width: 144px; float: left;">Nama</div>
                <div>: {{ $result->name }}</div>
            </div>
            <div style="display: flex; margin: 16px 0;">
                <div style="width: 144px; float: left;">Email</div>
                <div>: {{ $result->email }}</div>
            </div>
            <div style="display: flex; margin: 16px 0;">
                <div style="width: 144px; float: left;">No. HP</div>
                <div>: {{ $result->phone }}</div>
            </div>
            <div style="display: flex; margin: 16px 0;">
                <div style="width: 144px; float: left;">Usia</div>
                <div>: {{ $result->age }} Tahun</div>
            </div>
            <div style="display: flex; margin: 16px 0;">
                <div style="width: 144px; float: left;">Jenis Kelamin</div>
                <div>: {{ $result->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</div>
            </div>
            <div>
            </div>
        </div>

        <table>
            <thead>
                <th>No.</th>
                <th>Nama Pemeriksaan</th>
                <th>Hasil</th>
                <th>Keterangan</th>
            </thead>
            <tbody>
                @foreach ($data as $key => $p)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $p['name'] }} </td>
                        <td>{{ $p['hasil'] }}</td>
                        <td>{{ $p['keterangan'] ?: '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
