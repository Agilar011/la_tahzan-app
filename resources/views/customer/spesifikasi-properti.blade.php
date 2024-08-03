@extends('layouts.main')

@section('content')
    <div class="container mx-auto sm:p-4 bg-gray-100 min-w-full">
        <div class="bg-white rounded-lg flex flex-col sm:p-2 lg:flex-row">
            <!-- Carousel -->
            <div class="w-full lg:w-2/3">
                <div class="w-full grid gap-y-2">
                    {{-- Main Image --}}
                    <div class="hidden sm:block rounded-xl">
                        <img src="/img/produk properti 1.webp" alt="Gambar Utama" id="mainImage"
                            class="w-full h-96 object-cover rounded-xl">
                        <div class="hidden flex-col gap-x-2 mt-2 justify-center xl:flex sm:flex-row sm:flex-wrap">
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/produk properti 1.webp" alt="Placeholder Image 1"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/produk properti 2.webp" alt="Placeholder Image 2"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/produk properti 3.webp" alt="Placeholder Image 3"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/produk properti 4.webp" alt="Placeholder Image 4"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/produk properti 5.webp" alt="Placeholder Image 5"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/produk properti 6.webp" alt="Placeholder Image 6"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                        </div>
                    </div>
                    {{-- Mobile Carousel --}}
                    <div class="block sm:hidden">
                        <div class="carousel-container min-h-full sm:hidden">
                            <img src="/img/produk properti 1.webp" alt="Placeholder Image 1" class="carousel-item active">
                            <img src="/img/produk properti 2.webp" alt="Placeholder Image 2" class="carousel-item">
                            <img src="/img/produk properti 3.webp" alt="Placeholder Image 3" class="carousel-item">
                            <img src="/img/produk properti 4.webp" alt="Placeholder Image 4" class="carousel-item">
                            <div class="button-container">
                                <button class="prev" id="prev">&#10094;</button>
                                <button class="next" id="next">&#10095;</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const carouselItems = document.querySelectorAll('.carousel-item');
                            const prevButton = document.getElementById('prev');
                            const nextButton = document.getElementById('next');
                            let currentIndex = 0;

                            function updateCarousel() {
                                carouselItems.forEach((item, index) => {
                                    item.classList.toggle('active', index === currentIndex);
                                });
                            }

                            function showNextImage() {
                                currentIndex = (currentIndex + 1) % carouselItems.length;
                                updateCarousel();
                            }

                            function showPrevImage() {
                                currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
                                updateCarousel();
                            }

                            prevButton.addEventListener('click', showPrevImage);
                            nextButton.addEventListener('click', showNextImage);

                            setInterval(showNextImage, 5000); // Change image every 5 seconds

                            updateCarousel();
                        });
                    </script>
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
                            <td class="py-2">{{ $properti->luas_tanah }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Building Area</td>
                            <td class="py-2">{{ $properti->luas_bangunan }}</td>
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
                        <tr class="border-t">
                            <td class="py-2 font-bold">Facilities</td>
                            <td class="py-2">{{ $properti->fasilitas }}</td>
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
                            <td class="py-2">{{ $properti->luas_tanah }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Building Area</td>
                            <td class="py-2">{{ $properti->luas_bangunan }}</td>
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
                        <tr class="border-t">
                            <td class="py-2 font-bold">Facilities</td>
                            <td class="py-2">{{ $properti->fasilitas }}</td>
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
                <div class="flex text-center items-center w-full px-2">
                    <i class="fa-solid fa-hourglass-start fa-2xl"></i>
                    <div class="items-center justify-center">
                        <p class="ml-2 font-bold">{{ $properti->sellerBergabung }}</p>
                        <p class="mt-2 mx-2">Lama Bergabung</p>
                    </div>
                </div>
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
