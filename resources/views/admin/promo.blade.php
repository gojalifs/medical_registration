@extends('index')

@section('dash-content')
    <div class="text-xl">Preview Banner Slider</div>
    {{-- Please use image 17:8 ratio --}}
    <div id="default-carousel"
        class="relative w-full h-[175px] mx-auto md:w-[425px] md:h-[200px] lg:w-[680px] lg:h-[320px] xl:w-[935px] xl:h-[440px] mt-6"
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

    <hr class="my-4">

    <div>
        <div class="text-xl">Data Banner & Promo</div>
        <div class="mt-4">Silahkan upload gambar banner di sini...</div>
        <div class="text-red-700 text-sm">Note: Gunakan gambar dengan ratio 17:8! Ideal di
            <span class="font-bold">1360*640</span>
        </div>

        <form action="/banner" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex justify-center">
                <input type="image" id="blah" src="https://img.icons8.com/dotty/80/000000/upload.png"
                    class="m-4" />
                <input type='file' name="image" id="imgInp" accept="image/*" class="hidden" />
            </div>
            <div id="img-container" class="hidden h-56 md:h-96 w-full overflow-hidden bg-yellow-400">
                <img alt="" id="preview-img" class="object-cover h-full w-full">
            </div>
            <div class="mt-4 text-center">
                <button type="submit" id="submit"
                    class="bg-teal-400 px-2 py-1 hover:bg-teal-500 disabled:bg-gray-400 disabled:cursor-not-allowed"
                    disabled>Simpan</button>
            </div>
        </form>

        <hr class="my-8">

        <div class="text-lg">Data Banner Promo</div>

        {{-- Data image grid --}}
        <div id="image-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-2">

        </div>
    </div>
    <hr class="my-4">

    <div id="toast-danger"
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
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            data-dismiss-target="#toast-danger" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>

    <script>
        const image = document.getElementById('img');

        const imageData = null;

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-img').attr('src', e.target.result);
                    $('#img-container').removeClass('hidden');
                    $('#submit').removeAttr('disabled');
                }
                const a = reader.readAsDataURL(input.files[0]); // convert to base64 string
                console.log(a);

            }
        }

        $("#imgInp").change(function(e) {
            e.preventDefault()
            readURL(this);
        });

        $("input[type='image']").click(function(e) {
            e.preventDefault()
            $("input[id='imgInp']").click();
        });

        /// Get banner data
        const url = '/banner';

        fetch(url).then((result) => {
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

        function onDeleteClicked(index, id) {
            const confirmed = confirm(
                `Apa anda yakin ingin menghapus banner yang ke-${index}? Tindakan ini tidak dapat dibatalkan!`
            );

            if (confirmed) {
                const url = '/banner/delete';
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
                    } else {
                        document.getElementById('toast-danger').classList.remove('hidden');
                        document.getElementById('toast-danger').classList.add('flex');
                    }
                }).catch((err) => {
                    document.getElementById('toast-danger').classList.remove('hidden');
                    document.getElementById('toast-danger').classList.add('flex');
                });
            }
        }
    </script>
@endsection
