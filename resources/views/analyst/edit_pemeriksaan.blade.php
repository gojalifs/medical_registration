@extends('index')

@section('dash-content')
    <div class="max-w-[800px] mx-auto border rounded-xl px-8 py-4">
        <div class="text-center text-xl font-medium">Form Pengisian Hasil Medical Checkup</div>
        <hr class="my-4">
        <form action="{{ route('analyst.pemeriksaan.save') }}" method="post" id="form-pemeriksaan">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $pemeriksaan->periksa_id }}">
            <div class="grid grid-cols-2 gap-y-4" id="data_pemeriksaan_form">
                <div class="text-left text-gray-600">Nama</div>
                <div class="font-medium">: {{ $pemeriksaan->name }}</div>
                <div class="text-left text-gray-600">Tanggal</div>
                <div class="font-medium">: {{ $pemeriksaan->tanggal }}</div>
                <div class="text-left text-gray-600">Hasil Pemeriksaan</div>

                {{-- Form hasil pemeriksaan ditampilkan di sini --}}

            </div>
            <div>
                <label for=""></label>
            </div>
            <div class="text-center">
                <button type="button" id="save-btn"
                    class="text-center mt-4 px-3 py-1 bg-green-400 hover:bg-green-500 disabled:bg-gray-400 
                    disabled:hover:bg-gray-400 disabled:cursor-not-allowed">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        const path = $(location).attr("pathname");
        const paths = path.split('/');
        const pemId = paths[paths.length - 1];

        const json = {
            'id': pemId,
            'data': []
        };

        function onFieldChange(index, value, index1 = null, index2 = null) {

            if (index1 == null && index2 == null) {
                json['data'][index]['hasil'] = value;
            }
            if (index1 != null && index2 == null) {
                json['data'][index]['jenis'][index1]['hasil'] = value;
            }

            if (index1 != null && index2 != null) {
                json['data'][index]['jenis'][index1]['sub_jenis'][index2]['hasil'] = value;
            }
        }

        fetch('/pemeriksaan_data_edit/' + pemId).then((result) => {

            if (result.status == 200) {


                result.json().then((response) => {

                    let inputForm =
                        `<div class="col-span-2 grid grid-cols-2 px-8 items-center">`;

                    response.data.map((b, index) => {
                        const data1 = {
                            'id': b.id,
                            'hasil_id': b.hasil_id,
                            'jenis': []
                        };

                        let dataForm = `
                            ${index != 0 ? '<hr class="col-span-2 my-4">' : ''}
                            <input type="hidden" name="hp_id_${b.id}" id="sub_jenis_id" value="${ b.hasil_id }">
                            <input type="hidden" name="jenis_id_${b.id}" id="jenis_id" value="${ b.id }">
                            <div class="text-left text-gray-600 items-center align-middle">${ b.nama_pemeriksaan } </div>
                            <input type="text" name="jenis_name_${b.nama_pemeriksaan}" id="jenis"
                            oninput="onFieldChange(${index}, this.value)" value="${b.result ?? ''}"
                                placeholder="Masukkan hasil dan satuannya" ${ index == 0 ? 'autofocus' : '' }>
                        `;

                        let dataSubForm =
                            `<div class="ml-8 col-span-2 grid grid-cols-2 items-center">`;
                        const sjLength = b.sub_jenis.length;

                        b.sub_jenis.map((sj, indexSj) => {
                            const dataSub = {
                                'id': sj.id,
                                'hasil_id': sj.hasil_id,
                                'hasil': null,
                                'sub_jenis': []
                            };

                            let subForm = `
                                    <input type="hidden" name="hp_id_${sj.id}" id="sub_jenis_id" value="${ b.hasil_id }">
                                    <input type="hidden" name="sub_jenis_id_${sj.id}" id="sub_jenis_id" value="${ sj.id }">
                                    <div class="text-left text-gray-600" >${ sj.name } </div>
                                    <input type="text" name="sub_jenis_name_${sj.name}" id="jenis" class="my-1 w-full"
                                    oninput="onFieldChange(${index}, this.value, ${indexSj})" placeholder="Masukkan hasil dan satuannya"
                                    value="${sj.result}">
                                `;

                            if (sj.sub2.length !== 0) {
                                let dataSub2Form =
                                    `<div class="ml-8 col-span-2 grid grid-cols-2 items-center">`;

                                sj.sub2.map((s2, indexs2) => {
                                    const subJenis2 = {
                                        'id': s2.id,
                                        'name': s2.name,
                                        'hasil_id': s2.hasil_id,
                                        'hasil': null
                                    };                                    

                                    const sub2Form = `
                                        <input type="hidden" name="hp_id_${s2.id}" id="sub_jenis_id" value="${ b.hasil_id }">
                                        <input type="hidden" name="sub_jenis_2_id_${s2.id}" id="sub_jenis_id" value="${ s2.id }">
                                        <div class="text-left text-gray-600" >${ s2.name } </div>
                                        <input type="text" name="sub_jenis_2_name_${s2.name}" id="jenis" class="my-1 w-full" 
                                        oninput="onFieldChange(${index}, this.value, ${indexSj}, ${indexs2})" placeholder="Masukkan hasil dan satuannya"
                                        value="${s2.result}">
                                        ${indexs2 == sj.sub2.length - 1 ? '</div>' : ''}
                                    `;
                                    dataSub2Form += sub2Form;

                                    dataSub['sub_jenis'].push(subJenis2);
                                })


                                subForm += dataSub2Form;
                            }
                            data1['jenis'].push(dataSub);

                            indexSj == sjLength - 1 ? subForm += '</div>' : '';

                            dataSubForm += subForm;
                        });
                        json['data'].push(data1);

                        if (b.sub_jenis.length !== 0) dataForm += dataSubForm;
                        // index == response.data.length - 1 ? (inputForm += '</div>') : '';
                        inputForm += dataForm;
                    });


                    $('#data_pemeriksaan_form').append(inputForm);

                }).catch((err) => {

                });

            }
        }).catch((err) => {

        });

        $('#save-btn').click(function(e) {
            $(this).prop('disabled', true);

            saveData();

            $(this).prop('disabled', false);
            // $('#form-pemeriksaan').submit(function(e) => {

            // })
        })

        function saveData() {
            const request = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                },
                body: JSON.stringify(json)
            };

            fetch('/pemeriksaan', request).then((result) => {
                if (result.status == 201) {
                    window.location.href = '/pemeriksaan';
                }
            }).catch((err) => {

            });
        }
    </script>
@endsection
