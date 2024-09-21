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
        <div id="default-carousel"
            class="relative w-full h-[175px] mx-auto md:w-[425px] md:h-[200px] lg:w-[680px] lg:h-[320px] xl:min-w-[935px] xl:max-w-[1400px] xl:h-[440px] mt-6"
            data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-full overflow-hidden rounded-lg" id="banner_image_data">
                {{-- Banner Data will be shown here --}}
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse"
                id="banner_image_button">

            </div>
            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-teal-500/30 dark:bg-gray-800/30 group-hover:bg-teal-600/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-teal-500/30 dark:bg-gray-800/30 group-hover:bg-teal-600/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
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

    <script>
        fetch('/banner').then((result) => {
            if (result.status == 200) {
                result.json().then((response) => {
                    console.log(response);
                    response.data.map((b, index) => {
                        const banner = `
                        <div class="hidden duration-700 ease-in-out overflow-hidden" data-carousel-item>
                            <img src="${b.path}"
                                class="object-cover h-full mx-auto top-1/2 left-1/2" alt="...">
                        </div>
                        `;

                        const button = `
                        <button type="button" class="w-3 h-3 bg-teal-500 rounded-full" aria-current="true" aria-label="Slide ${index}"
                            data-carousel-slide-to="${index}"></button>
                        `;

                        const imageGrid = `
                        <div class="bg-red-400 relative">
                            <img src="${b.path}" alt="" class="h-[240px] sm:h-[180px] md:h-[150px] lg:h-[180px] mx-auto">
                            <button type="button">
                                <div class="absolute top-2 right-2 p-1 bg-white border rounded-full text-center content-center text-lg hover:bg-gray-200
                                    cursor-pointer" id="delete-btn" onclick="onDeleteClicked(${ index+1 }, ${ b.id })">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                </div>  
                            </button>
                        </div>
                        `;

                        $('#banner_image_data').append(banner);
                        $('#banner_image_button').append(button);
                        $('#image-grid').append(imageGrid);

                    })

                }).catch((err) => {

                });
                console.log();

            }
        }).catch((err) => {

        });
    </script>
@endsection
