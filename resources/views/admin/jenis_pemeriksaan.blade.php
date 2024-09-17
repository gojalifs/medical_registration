@extends('index')

@section('dash-content')
    <div>
        <div class="flex justify-between">
            <div>Data Jenis Pemeriksaan dan Ruangannya</div>
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="flex bg-green-400 hover:bg-teal-300 px-3 py-1">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
                Tambah
            </button>
        </div>
        <table class="table-auto w-full mt-8 border-collapse h-[1px]">
            <thead>
                <th class="border px-2 py-1">No.</th>
                <th class="border px-2 py-1">Nama Pemeriksaan</th>
                <th class="border px-2 py-1">Ruangan</th>
                <th class="border px-2 py-1">Sub Tes</th>
                <th class="border px-2 py-1">Aksi</th>
            </thead>
            <tbody id="table_body">
            </tbody>
        </table>
    </div>

    {{-- Edit Subtes Modal --}}
    <div id="crud-subtes-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="title-edit">
                        Ubah Master jenis Pemeriksaan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-subtes-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="px-4 pt-2">Nama Pemeriksaan</div>
                <form action="{{ route('admin.jenis.sub.update') }}" class="px-4 flex space-x-4 items-center my-4"
                    method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id_sub">
                    <input type="hidden" name="jenis_id" id="jenis_id">
                    <div class="grid gap-4 my-1 grid-cols-2 w-full" id="edit-subtest-form">
                        <div class="col-span-2">
                            <input type="text" name="name" id="name_sub"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Ketikkan nama pemeriksaan... (rontgent, darah, dll)" required>
                        </div>

                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit"
                            class="text-white inline-flex items-center bg-teal-500 hover:bg-teal-600 hover:ring-teal-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-6 h-6 text-white dark:text-black" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 11.917 9.724 16.5 19 7.5" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="button" onclick=deleteSub()
                            class="text-white mx-auto bg-red-500 hover:bg-red-600 hover:ring-teal-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-6 h-6 text-white dark:text-white" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
                <div class="px-4 pt-2">Nama Sub Pemeriksaan</div>
                <div id="form_add_edit_sub_pemeriksaan" class="pb-2"> </div>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Master jenis Pemeriksaan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('admin.jenis.save') }}" class="p-4 md:p-5" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Pemeriksaan</label>
                            <input type="text" name="name" id="pemeriksaan_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Ketikkan nama pemeriksaan... (rontgent, darah, dll)" required>
                        </div>
                        <div class="col-span-2">
                            <label for="room"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama/kode
                                Ruangan</label>
                            <input type="text" name="room" id="pemeriksaan_room"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Ketikkan nama/kode ruangan..." required>
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
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div class="fixed top-32 right-0 mr-10 pb-10">
        @if (Session::get('success'))
            <div id="toast-success"
                class="items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-teal-50 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ Session::get('success') }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        @if ($errors->has('message'))
            <div id="toast-danger"
                class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-teal-50 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                    </svg>
                    <span class="sr-only">Error icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ $errors->first() }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-danger" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        @if ($errors->has('message'))
            <div id="toast-error"
                class="hidden items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-teal-50 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                    </svg>
                    <span class="sr-only">Error icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ $errors->first() }}</div>
                <div class="ms-3 text-sm font-normal" id="toast-message"></div>
                <button type="button" disabled
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-error" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
    </div>

    <script>
        setTimeout(function() {
            $('#toast-success').fadeOut('fast');
            $('#toast-error').fadeOut('fast');
            $('#toast-danger').fadeOut('fast');
        }, 3000); // <-- time in milliseconds

        getIndexData();

        var jenisPemeriksaanId = 0;
        var subJenisPemeriksaanId = 0;
        var btnEditSubJenisId = 0;
        var subName = '';
        var sub2Length = 0;

        const formAddEditSubPemeriksaan = document.getElementById('form_add_edit_sub_pemeriksaan');

        const emptyForm = `
            <div class="px-4 flex space-x-4 items-center my-4">
                <input type="hidden" name="jenis_id" id="id" value="${btnEditSubJenisId}">
                <div class="grid gap-4 my-1 grid-cols-2 w-full" id="edit-subtest-form">
                    <div class="col-span-2">
                        {{-- <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nama Sub Pemeriksaan
                        </label> --}}
                        <input type="text" name="name" id="empty-names" oninput="emptyFieldOnChange(this.value)"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Ketikkan nama pemeriksaan... (rontgent, darah, dll)" required>
                    </div>

                </div>
                <div class="flex items-center justify-center">
                    <button type="button" onclick="saveNewData()" disabled
                        id="empty-btn"
                        class="disabled:bg-slate-500 disabled:cursor-not-allowed text-white inline-flex items-center bg-teal-500 hover:bg-teal-600 hover:ring-teal-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">                       
                        <svg class="w-6 h-6 text-white dark:text-black" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="error_add_message" class="text-red-400 px-4 flex space-x-4 items-center my-4"></div>
            `;

        const loadingIcon = `<svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                        <span class="sr-only">Loading...</span>`;

        const readyIcon = `<svg class="w-6 h-6 text-white dark:text-black" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                        </svg>`;

        function getIndexData() {
            const route = `{{ route('admin.jenis.data') }}`;
            const request = {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                }
            };

            fetch(route, request).then((response) => {
                if (response.status == 200) {
                    response.json().then((res) => {
                        setTableData(res.data);
                    })
                } else {
                    const toastError = document.getElementById('toast-error');
                }
            }).catch((err) => {});
        }

        function setTableData(data) {
            const tableBodyId = document.getElementById('table_body');
            let tr = `<tr>`;
            data.forEach((d, index) => {
                const no = index + 1;
                const namaPemeriksaan = d.nama_pemeriksaan;
                const ruangan = d.ruang;

                dataSubTes = '<ul class="list-disc ml-4">';
                d.sub_jenis.map((sj) => {
                    dataSubTes += `<li class="my-2 flex justify-between">
                            <div>
                                ${sj.name }
                                <ul class="list-decimal ml-4 my-2">`;

                    sj.sub2.map((sub2) => {
                        dataSubTes += `
                            <li class="flex list-disc">
                                ${ sub2.name }
                            </li>
                        `;
                    })

                    dataSubTes += `
                                </ul>
                            </div>
                            <div>
                                <button class="flex rounded-sm px-2 py-1"
                                    id="edit_sub_jenis_${ sj.id }"
                                    data-modal-toggle="crud-subtes-modal" type="button"
                                    onclick="setModalId(${ d.id }, ${ sj.id })"
                                    data-title="${ sj.name }"
                                    data-sub-pemeriksaan='${JSON.stringify( sj.sub2 )}'>
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-red-500"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                            clip-rule="evenodd" />
                                        <path fill-rule="evenodd"
                                            d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </li>
                    `;

                    return dataSubTes;
                });

                dataSubTes += '</ul>';

                const aksi = `
                    <div class="flex space-x-4 align-top h-full">
                        <div>
                            <button class="flex bg-green-400 rounded-sm px-2 py-1 hover:text-white group"
                                data-modal-target="crud-subtes-modal" data-modal-toggle="crud-modal"
                                id="btn_edit_main_category${d.id}"
                                data-title="Ubah Data Tes ${d.nama_pemeriksaan}" data-ruangan="${d.ruang }"
                                onclick="setMainEditData(${d.id})">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white group-hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd"
                                        d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Edit
                                </button>
                        </div>
                        <form action="{{ route('admin.jenis.delete') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" id="id" value="${d.id}">
                            <button
                                class="flex bg-red-400 rounded-sm px-2 py-1 hover:bg-red-600 group hover:text-white"
                                type="submit">
                                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white group-hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </form>
                `;

                tr += `<td class="border px-2 py-1 content-start">${no}</td>`;
                tr += `<td class="border px-2 py-1 content-start">${namaPemeriksaan}</td>`;
                tr += `<td class="border px-2 py-1 content-start">${ruangan}</td>`;
                tr += `<td class="border px-2 py-1 content-start">${dataSubTes}</td>`;
                tr += `<td class="border px-2 py-1 content-start">${aksi}</td>`;

                tr += '</tr>';
            });


            tableBodyId.innerHTML = tr;
        }

        function emptyFieldOnChange(val) {
            const emptyBtn = document.getElementById('empty-btn');
            if (val.length == 0) {
                emptyBtn.disabled = true;
                emptyBtn.classList.add(['disabled:bg-slate-500', 'disabled:cursor-not-allowed']);
            } else {
                emptyBtn.disabled = false;
                emptyBtn.classList.remove(['disabled:bg-slate-500', 'disabled:cursor-not-allowed']);
            }
        }

        function setModalId(jenisId, id) {

            jenisPemeriksaanId = jenisId;
            btnEditSubJenisId = id;
            const pemeriksaanIdInput = document.getElementById('id_sub');
            const pemeriksaanJenisIdInput = document.getElementById('jenis_id');
            const pemeriksaanNameInput = document.getElementById('name_sub');
            const btnEditSubJenis = document.getElementById(`edit_sub_jenis_${id}`);
            subJenisPemeriksaanId = id;
            const subJenisName = btnEditSubJenis.getAttribute('data-title');
            subName = subJenisName;
            pemeriksaanIdInput.value = id;
            pemeriksaanJenisIdInput.value = jenisId;
            pemeriksaanNameInput.value = subJenisName;
            document.getElementById('title-edit').innerHTML = `Ubah Subtes ${subJenisName}`;

            const dataPemeriksaan = btnEditSubJenis.getAttribute('data-sub-pemeriksaan');

            const dataJson = JSON.parse(dataPemeriksaan);
            sub2Length = dataJson.length;

            formAddEditSubPemeriksaan.innerHTML = '';

            dataJson.forEach((e) => {
                const form = `
                    <form action="{{ route('admin.jenis.sub2.update') }}" class="px-4 flex space-x-4 items-center my-4" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="${e['id']}">
                        <input type="hidden" name="sub_id" id="id" value="${id}">
                        <div class="grid gap-4 my-1 grid-cols-2 w-full" id="edit-subtest-form">
                            <div class="col-span-2">
                                <input type="text" name="name" id="name" value="${e['name']}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Ketikkan nama pemeriksaan... (rontgent, darah, dll)" required>
                            </div>
    
                        </div>
                        <div class="flex items-center justify-center">
                            <button type="submit"
                                class="text-white inline-flex items-center bg-teal-500 hover:bg-teal-600 hover:ring-teal-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-6 h-6 text-white dark:text-black" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex items-center justify-center">
                             <button type="button"
                             onclick="deleteSub2(${e['id']}, '${e['name']}')"
                                class="text-white mx-auto bg-red-500 hover:bg-red-600 hover:ring-teal-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-6 h-6 text-white dark:text-white"
                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </form>
                `;
                formAddEditSubPemeriksaan.innerHTML += form;
            });

            formAddEditSubPemeriksaan.innerHTML += emptyForm;

        }

        function addSubJenis2(id, data) {
            const newData = `
        <form action="{{ route('admin.jenis.addSubTes2') }}" class="px-4 flex space-x-4 items-center my-4" method="POST">
            @csrf
            <input type="hidden" name="id" id="id" value="${id}">
            <div class="grid gap-4 my-1 grid-cols-2 w-full" id="edit-subtest-form">
                <div class="col-span-2">
                    {{-- <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nama Sub Pemeriksaan
                        </label> --}}
                    <input type="text" name="name" id="name" value="${name}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Ketikkan nama pemeriksaan... (rontgent, darah, dll)" required>
                </div>

            </div>
            <div class="flex items-center justify-center">
                <button type="submit"
                    class="text-white inline-flex items-center bg-teal-500 hover:bg-teal-600 hover:ring-teal-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-6 h-6 text-white dark:text-black" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                    </svg>
                </button>
            </div>
            <div class="flex items-center justify-center">
                    <button type="button"
                    class="text-white mx-auto bg-red-500 hover:bg-red-600 hover:ring-teal-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-6 h-6 text-white dark:text-white"
                        xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
        `;

            const btnEditSubJenis = document.getElementById(`edit_sub_jenis_${btnEditSubJenisId}`);
            const dataPemeriksaan = btnEditSubJenis.getAttribute('data-sub-pemeriksaan');
            const dataJson = JSON.parse(dataPemeriksaan);

            dataJson.splice(dataJson.length, 0, data);

            formAddEditSubPemeriksaan.innerHTML = '';
            dataJson.forEach(e => {
                const form = `
                    <form action="{{ route('admin.jenis.addSubTes2') }}" class="px-4 flex space-x-4 items-center my-4" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="${e['id']}">
                        <div class="grid gap-4 my-1 grid-cols-2 w-full" id="edit-subtest-form">
                            <div class="col-span-2">
                                {{-- <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Nama Sub Pemeriksaan
                                </label> --}}
                                <input type="text" name="name" id="name" value="${e['name']}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Ketikkan nama pemeriksaan... (rontgent, darah, dll)" required>
                            </div>
    
                        </div>
                        <div class="flex items-center justify-center">
                            <button type="submit"
                                class="text-white inline-flex items-center bg-teal-500 hover:bg-teal-600 hover:ring-teal-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-6 h-6 text-white dark:text-black" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex items-center justify-center">
                             <button type="button"
                                class="text-white mx-auto bg-red-500 hover:bg-red-600 hover:ring-teal-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-6 h-6 text-white dark:text-white"
                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </form>
                `;
                formAddEditSubPemeriksaan.innerHTML += form;
            });

            formAddEditSubPemeriksaan.innerHTML += newData;
        }

        function setMainEditData(id) {

            const btneditJenis = document.getElementById(`btn_edit_main_category${id}`);
            const name = btneditJenis.getAttribute('data-title');
            const ruang = btneditJenis.getAttribute('data-ruangan');
            document.getElementById('pemeriksaan_name').value = name;
            document.getElementById('pemeriksaan_room').value = ruang;
        }

        function saveNewData() {
            const nameData = document.getElementById(`empty-names`);

            const data = {
                jenis_pemeriksaan_id: subJenisPemeriksaanId,
                name: nameData.value
            };

            const route = `{{ route('admin.jenis.addSubTes2') }}`;

            const request = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                },
                body: JSON.stringify(data)
            };

            fetch(route, request).then((response) => {
                if (response.status == 201) {
                    response.json().then((res) => {
                        // addSubJenis2(2, res.data);
                        location.reload();
                        document.getElementById('toast-success').classList.add('flex');
                        document.getElementById('toast-success').classList.remove('hidden');
                    })
                } else {
                    const toastError = document.getElementById('toast-error');
                    document.getElementById('error_add_message').innerHTML = response.status;
                    toastError.classList.add('flex');
                    toastError.classList.remove('hidden');
                }
            }).catch((err) => {
                document.getElementById('toast-error').classList.add('flex');
                document.getElementById('toast-error').classList.remove('hidden');
            });

        }

        function deleteSub() {
            if (sub2Length > 0) {
                alert(`Sub tes ${subName} memiliki sub-sub tes. Anda harus menghapusnya terlebih dahulu!`);
                return;
            }
            const id = btnEditSubJenisId;
            deleteSub2(id, subName, true);
        }

        function deleteSub2(id, name, isFirstSub = false) {
            const confirmed = confirm(
                `Apa anda yakin ingin menghapus sub tes ${name}? Tindakan ini tidak dapat dibatalkan dan dapat mempengaruhi data pemeriksaan pasien!`
            );
            if (confirmed) {
                const url = isFirstSub ? '/jenis-pemeriksaan/sub_delete' : '/jenis-pemeriksaan/sub2_delete';

                const request = {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                    },
                    body: JSON.stringify({
                        'id': id
                    })
                };

                fetch(url, request).then((response) => {
                    if (response.status == 200) {
                        location.reload();
                        document.getElementById('toast-success').classList.add('flex');
                        document.getElementById('toast-success').classList.remove('hidden');
                        // response.json().then((res) => {
                        // })
                    } else {
                        const toastError = document.getElementById('toast-error');
                        document.getElementById('error_add_message').innerHTML = response.status;
                        toastError.classList.add('flex');
                        toastError.classList.remove('hidden');
                    }
                }).catch((err) => {
                    document.getElementById('toast-error').classList.add('flex');
                    document.getElementById('toast-error').classList.remove('hidden');
                });

            }
        }
    </script>
@endsection
