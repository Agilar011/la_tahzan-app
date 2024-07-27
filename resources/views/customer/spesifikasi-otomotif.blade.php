@extends('layouts.main')

@section('content')
    <div class="container mx-auto sm:p-4 bg-gray-100 min-w-full">
        <div class="bg-white rounded-lg flex flex-col sm:p-2 lg:flex-row">
            <!-- Carousel -->
            <div class="w-full lg:w-2/3">
                <div class="w-full grid gap-y-2">

                    {{-- Div gambar utama --}}
                    <div class="hidden sm:block rounded-xl">
                        <img src="/img/produk otomotif 1.webp" alt="Gambar Utama" id="mainImage"
                            class="w-full h-96 object-cover rounded-xl">
                        <div class="hidden flex-col gap-x-2 mt-2 justify-center xl:flex sm:flex-row sm:flex-wrap">
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/produk otomotif 1.webp" alt="Placeholder Image 1"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/produk otomotif 2.webp" alt="Placeholder Image 2"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/produk otomotif 3.webp" alt="Placeholder Image 3"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>

                            <div class="w-full sm:w-[15%]">
                                <img src="/img/produk otomotif 4.webp" alt="Placeholder Image 4"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/produk otomotif 4.webp" alt="Placeholder Image 5"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/produk otomotif 4.webp" alt="Placeholder Image 6"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                        </div>

                    </div>
                    {{-- end div gambar --}}

                    {{-- section carousel mobile --}}
                    <style>
                        .carousel-item {
                            display: none;
                            /* height: 100%; */
                            border-radius: 10px;
                        }.carousel-container {
                                height: 60vh;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                overflow: hidden;
                                /* background-color: #fff;
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
                                border-radius: 10px;
                            }
                            .carousel-item {
                                display: none;
                                width: auto;
                                height: 100%;
                                border-radius: 10px;
                                object-fit: cover;
                            }
                            .carousel-item.active {
                                display: block;
                            }
                        .carousel-item.active {
                            display: block;
                        }
                        .button-container {
                            position: absolute;
                            top: 50%;
                            width: 100%;
                            display: flex;
                            justify-content: space-between;
                            transform: translateY(-50%);
                        }
                        .prev, .next {
                            background-color: rgba(0, 0, 0, 0.5);
                            color: white;
                            border: none;
                            padding: 10px;
                            cursor: pointer;
                        }
                    </style>

                    <div class="block sm:hidden">
                        <div class="carousel-container min-h-full sm:hidden">
                            <img src="/img/produk otomotif 1.webp" alt="Placeholder Image 1" class="carousel-item active">
                            <img src="/img/produk otomotif 2.webp" alt="Placeholder Image 2" class="carousel-item">
                            <img src="/img/produk otomotif 3.webp" alt="Placeholder Image 3" class="carousel-item">
                            <img src="/img/produk otomotif 4.webp" alt="Placeholder Image 4" class="carousel-item">
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
                                console.log(`updateCarousel called. Current Index: ${currentIndex}`);
                            }

                            function showNextImage() {
                                console.log("showNextImage called. Current Index:", currentIndex);
                                currentIndex = (currentIndex + 1) % carouselItems.length;
                                updateCarousel();
                                console.log("Next Image Shown. Updated Current Index:", currentIndex);
                            }

                            function showPrevImage() {
                                console.log("showPrevImage called. Current Index:", currentIndex);
                                currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
                                updateCarousel();
                                console.log("Previous Image Shown. Updated Current Index:", currentIndex);
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
                    {{ number_format($otomotif->harga, 0, ',', '.') }}</p>
                <h1 class="text-2xl font-bold mb-4">{{ $otomotif->judul_produk }}</h1>
                <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate rem quis
                    sed assumenda voluptatum deleniti pariatur vel animi aliquid, quibusdam provident quia? Modi, officiis?
                    Ea fuga porro quibusdam quidem omnis.</p>
                <table class="table-auto w-full mb-4">
                    <tbody>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Type</td>
                            <td class="py-2">{{ $otomotif->type }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Sub Type</td>
                            <td class="py-2">{{ $otomotif->subtype }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Transmisi</td>
                            <td class="py-2">{{ $otomotif->transmisi }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Kilometer</td>
                            <td class="py-2">{{ $otomotif->kilometer }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Kapasitas Mesin</td>
                            <td class="py-2">{{ $otomotif->kapasitas_mesin }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Merk</td>
                            <td class="py-2">{{ $otomotif->brand }}</td>
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
                <h1 class="text-4xl font-bold mb-4">{{ $otomotif->judul_produk }}</h1>
                <p class="text-2xl text-gray-900 mb-4 font-bold">Rp. {{ number_format($otomotif->harga, 0, ',', '.') }}</p>
                <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate rem quis
                    sed assumenda voluptatum deleniti pariatur vel animi aliquid, quibusdam provident quia? Modi, officiis?
                    Ea fuga porro quibusdam quidem omnis.</p>
                <table class="table-auto w-full mb-4">
                    <tbody>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Type</td>
                            <td class="py-2">{{ $otomotif->type }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Sub Type</td>
                            <td class="py-2">{{ $otomotif->subtype }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Transmisi</td>
                            <td class="py-2">{{ $otomotif->transmisi }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Kilometer</td>
                            <td class="py-2">{{ $otomotif->kilometer }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Kapasitas Mesin</td>
                            <td class="py-2">{{ $otomotif->kapasitas_mesin }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Merk</td>
                            <td class="py-2">{{ $otomotif->brand }}</td>
                        </tr>
                    </tbody>
                </table>

                <button class="mb-2 px-4 py-2 text-white rounded" style="background-color: #25D366">
                    <span class="flex">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp"
                            style="width: 24px; height: 24px;" class="mr-2">
                        <p>Contact Seller</p>
                    </span>
                </button>
            </div>
        </div>
        {{-- Section Seller --}}
        <div class="flex bg-white w-full p-5 rounded-lg mt-5">
            <div class="flex w-full justify-between divide-x-4">

                <!-- Div untuk informasi Seller -->
                <div class="flex items-center text-center ">
                    <i class="fa-solid fa-user fa-2xl" style="color: #000000;"></i>
                    <p class="ml-2">{{ $otomotif->name }}</p>
                </div>

                <!-- Div untuk informasi produk dan bergabung -->
                <div class="flex w-2/3 lg:w-1/3 justify-between divide-x-4 px-2">
                    <!-- Div untuk jumlah produk -->
                    <div class="flex text-center items-center w-full">
                        <i class="fa-solid fa-bag-shopping fa-2xl" style="color: #B197FC;"></i>
                        <div class="items-center justify-center">
                            <p class="ml-2 font-bold">{{ $otomotif->jumlahProduk }}</p>
                            <p class="mt-2 mx-2">Jumlah Produk Dijual</p>
                        </div>
                    </div>

                    <!-- Div untuk lama bergabung -->
                    <div class="flex text-center items-center w-full px-2">
                        <i class="fa-solid fa-hourglass-start fa-2xl"></i>
                        <div class="items-center justify-center">
                            <p class="ml-2 font-bold">{{ $otomotif->sellerBergabung }}</p>
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
