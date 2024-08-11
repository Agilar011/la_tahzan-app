@extends('layouts.main')

@section('content')
    <div class="container mx-auto sm:p-4 bg-gray-100 min-w-full">
        <div class="bg-white rounded-lg flex flex-col sm:p-2 lg:flex-row">
            <!-- Carousel -->
            <div class="w-full lg:w-2/3">
                <style>
                    .carousel-image {
                        height: 600px; /* Adjust this value as needed */
                        object-fit: cover;
                    }
                </style>
                <div id="carouselExampleIndicators" class="carousel slide rounded-xl" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($photo->fotos as $index => $foto)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}"
                                class="{{ $index == 0 ? 'active' : '' }}" aria-current="true"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($photo->fotos as $index => $foto)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/foto_properti/' . $foto->path) }}" class="d-block w-100 img-fluid carousel-image" alt="...">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Product Details Mobile-->
            <div class="w-full pt-5 sm:hidden lg:w-1/2 lg:pl-8 ">
                <p class="text-3xl text-gray-900 mb-4 font-black">Rp.
                    {{ number_format($properti->harga, 0, ',', '.') }}</p>
                <h1 class="text-2xl font-bold mb-4">{{ $properti->judul_produk }}</h1>
                <p class="text-gray-700 mb-4">{{ $properti->deskripsi_produk }}</p>
                <table class="table-auto w-full mb-4">
                    <tbody>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Address</td>
                            <td class="py-2">{{ $properti->alamat }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">City</td>
                            <td class="py-2">{{ $properti->kota }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Province</td>
                            <td class="py-2">{{ $properti->provinsi }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Property Type</td>
                            <td class="py-2">{{ $properti->jenis_properti }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Land Area</td>
                            <td class="py-2">{{ $properti->luas_tanah }}m²</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Building Area</td>
                            <td class="py-2">{{ $properti->luas_bangunan }}m²</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Number of Bedrooms</td>
                            <td class="py-2">{{ $properti->jumlah_kamar_tidur }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Number of Bathrooms</td>
                            <td class="py-2">{{ $properti->jumlah_kamar_mandi }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Certificate</td>
                            <td class="py-2">{{ $properti->sertifikat }}</td>
                        </tr>
                    </tbody>
                </table>

                <button class="px-4 py-2 text-white rounded mb-2" style="background-color: #25D366">
                    <span class="flex">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp"
                            style="width: 24px; height: 24px;" class="mr-2">
                        <p>Contact Seller</p>
                    </span>
                </button>
            </div>

            <!-- Product Details -->
            <div class="hidden sm:block w-full pt-5 lg:w-1/2 lg:pl-8 ">
                <h1 class="text-4xl font-bold mb-4">{{ $properti->judul_produk }}</h1>
                <p class="text-2xl text-gray-900 mb-4 font-bold">Rp. {{ number_format($properti->harga, 0, ',', '.') }}</p>
                <p class="text-gray-700 mb-4">{{ $properti->deskripsi_produk }}</p>
                <table class="table-auto w-full mb-4">
                    <tbody>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Address</td>
                            <td class="py-2">{{ $properti->alamat }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">City</td>
                            <td class="py-2">{{ $properti->kota }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Province</td>
                            <td class="py-2">{{ $properti->provinsi }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Property Type</td>
                            <td class="py-2">{{ $properti->jenis_properti }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Land Area</td>
                            <td class="py-2">{{ $properti->luas_tanah }}m²</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Building Area</td>
                            <td class="py-2">{{ $properti->luas_bangunan }}m²</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Number of Bedrooms</td>
                            <td class="py-2">{{ $properti->jumlah_kamar_tidur }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Number of Bathrooms</td>
                            <td class="py-2">{{ $properti->jumlah_kamar_mandi }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Certificate</td>
                            <td class="py-2">{{ $properti->sertifikat }}</td>
                        </tr>
                    </tbody>
                </table>

                <button class="px-4 py-2 text-white rounded mb-2" style="background-color: #25D366">
                    <span class="flex">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp"
                            style="width: 24px; height: 24px;" class="mr-2">
                        <p>Contact Seller</p>
                    </span>
                </button>
            </div>
        </div>
    </div>

     {{-- Section Seller --}}
     <div class="flex bg-white w-full p-5 rounded-lg mt-5">
        <div class="flex w-full justify-between divide-x-4">
            <!-- Div untuk informasi Seller -->
            <div class="flex items-center text-center ">
                <i class="fa-solid fa-user fa-2xl" style="color: #000000;"></i>
                <p class="ml-2">{{ $properti->name }}</p>
            </div>

            <!-- Div untuk informasi produk dan bergabung -->
            <div class="flex w-2/3 lg:w-1/3 justify-between divide-x-4 px-2">
                <!-- Div untuk jumlah produk -->
                <div class="flex text-center items-center w-full">
                    <i class="fa-solid fa-bag-shopping fa-2xl" style="color: #B197FC;"></i>
                    <div class="items-center justify-center">
                        <p class="ml-2 font-bold">{{ $properti->jumlahProduk }}</p>
                        <p class="mt-2 mx-2">Jumlah Produk Dijual</p>
                    </div>
                </div>

                <!-- Div untuk lama bergabung -->
                <div class="flex text-center items-center w-full">
                    <i class="fa-solid fa-calendar-plus fa-2xl" style="color: #FFABE1;"></i>
                    <div class="items-center justify-center">
                        <p class="ml-2 font-bold">{{ $properti->sellerBergabung }}</p>
                        <p class="mt-2 mx-2">Tahun Bergabung</p>
                    </div>
                </div>
            </div>

            <!-- Div untuk badge seller -->
            <div class="flex justify-center items-center w-1/3 lg:w-1/4">
                <img src="{{ asset('img/Group 119.png') }}" alt="Trusted" class="h-16">
            </div>
        </div>
    </div>

    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endsection
