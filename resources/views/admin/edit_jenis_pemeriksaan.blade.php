@extends('index')

@section('dash-content')
    <div>
        <div>
            Detail Pemeriksaan <span class="italic font-bold"> {{ $data[0]->name }} </span>

            <table>
                <thead>
                    <th>No.</th>
                    <th>Nama Sub Pemeriksaan</th>
                    <th>Sub Pemeriksaan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $value->name }} </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
