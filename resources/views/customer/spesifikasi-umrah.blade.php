@extends('layouts.main')

@section('content')
    <div class="container mx-auto sm:p-4 bg-gray-100 min-w-full">
        <div class="bg-white rounded-lg flex flex-col sm:p-2 lg:flex-row">
            <!-- Carousel -->
            <div class="w-full lg:w-2/3">
                <div class="w-full grid gap-y-2">

                    {{-- Main Image Div --}}
                    <div class="hidden sm:block rounded-xl">
                        <img src="/img/umrah/umrah-1.webp" alt="Gambar Utama" id="mainImage"
                            class="w-full h-96 object-cover rounded-xl">
                        <div class="hidden flex-col gap-x-2 mt-2 justify-center xl:flex sm:flex-row sm:flex-wrap">
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/umrah/umrah-1.webp" alt="Placeholder Image 1"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/umrah/umrah-2.webp" alt="Placeholder Image 2"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                            <div class="w-full sm:w-[15%]">
                                <img src="/img/umrah/umrah-3.webp" alt="Placeholder Image 3"
                                    class="w-full h-40 object-cover thumbnail rounded-lg">
                            </div>
                        </div>
                    </div>
                    {{-- end main image div --}}

                    {{-- Mobile carousel --}}
                    <style>
                        .carousel-item {
                            display: none;
                            border-radius: 10px;
                        }
                        .carousel-container {
                            height: 60vh;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            overflow: hidden;
                            border-radius: 10px;
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
                            <img src="/img/umrah/umrah-1.webp" alt="Placeholder Image 1" class="carousel-item active">
                            <img src="/img/umrah/umrah-2.webp" alt="Placeholder Image 2" class="carousel-item">
                            <img src="/img/umrah/umrah-3.webp" alt="Placeholder Image 3" class="carousel-item">
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

                            setInterval(showNextImage, 5000);

                            updateCarousel();
                        });
                    </script>
                </div>
            </div>

            <!-- Product Details Mobile-->
            <div class="w-full pt-5 sm:hidden lg:w-1/2 lg:pl-8 ">
                <p class="text-3xl text-gray-900 mb-4 font-black">Rp.
                    {{ number_format($umrah->harga, 0, ',', '.') }}</p>
                <h1 class="text-2xl font-bold mb-4">{{ $umrah->judul_produk }}</h1>
                <p class="text-gray-700 mb-4">{{ $umrah->deskripsi_produk }}</p>
                <table class="table-auto w-full mb-4">
                    <tbody>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Agen Travel</td>
                            <td class="py-2">{{ $umrah->agen_travel }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Nomor Telefon Agen</td>
                            <td class="py-2">{{ $umrah->nomor_telefon_agen }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Maskapai</td>
                            <td class="py-2">{{ $umrah->maskapai }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Hotel</td>
                            <td class="py-2">{{ $umrah->hotel }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Tanggal Keberangkatan</td>
                            <td class="py-2">{{ $umrah->tanggal_keberangkatan }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Durasi</td>
                            <td class="py-2">{{ $umrah->durasi }} hari</td>
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
                <h1 class="text-4xl font-bold mb-4">{{ $umrah->judul_produk }}</h1>
                <p class="text-2xl text-gray-900 mb-4 font-bold">Rp. {{ number_format($umrah->harga, 0, ',', '.') }}</p>
                <p class="text-gray-700 mb-4">{{ $umrah->deskripsi_produk }}</p>
                <table class="table-auto w-full mb-4">
                    <tbody>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Agen Travel</td>
                            <td class="py-2">{{ $umrah->agen_travel }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Nomor Telefon Agen</td>
                            <td class="py-2">{{ $umrah->nomor_telefon_agen }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Maskapai</td>
                            <td class="py-2">{{ $umrah->maskapai }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Hotel</td>
                            <td class="py-2">{{ $umrah->hotel }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Tanggal Keberangkatan</td>
                            <td class="py-2">{{ $umrah->tanggal_keberangkatan }}</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 font-bold">Durasi</td>
                            <td class="py-2">{{ $umrah->durasi }} hari</td>
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

        <!-- Additional Details and FAQ -->
        <div class="mt-4">
            <div class="flex bg-white w-full p-5 rounded-lg mt-5">
                <div class="flex w-full justify-between divide-x-4">

                    <!-- Div untuk informasi Seller -->
                    <div class="flex items-center text-center ">
                        <i class="fa-solid fa-user fa-2xl" style="color: #000000;"></i>
                        <p class="ml-2">{{ $umrah->agen_travel }}</p>
                    </div>

                    <!-- Div untuk informasi produk dan bergabung -->
                    <div class="flex w-2/3 lg:w-1/3 justify-between divide-x-4 px-2">

                        <!-- Div untuk lama bergabung -->
                        <div class="flex text-center items-center w-full px-2">
                            <i class="fa-solid fa-hourglass-start fa-2xl"></i>
                            <div class="items-center justify-center">
                                <p class="ml-2 font-bold">{{ $umrah->sellerBergabung }}</p>
                                <p class="mt-2 mx-2">Lama Bergabung</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg sm:p-4 mt-4">
                <h2 class="text-2xl font-bold mb-4">Frequently Asked Questions (FAQ)</h2>
                <div x-data="{ faqOpen: null }">
                    <div class="border-b border-gray-200 mb-4">
                        <button class="w-full text-left py-2 px-4 font-semibold text-gray-700 focus:outline-none"
                            @click="faqOpen = faqOpen === 1 ? null : 1">
                            What is included in the package?
                        </button>
                        <div class="px-4 py-2" x-show="faqOpen === 1" style="display: none;">
                            <p class="text-gray-600">[Details about package inclusions]</p>
                        </div>
                    </div>
                    <div class="border-b border-gray-200 mb-4">
                        <button class="w-full text-left py-2 px-4 font-semibold text-gray-700 focus:outline-none"
                            @click="faqOpen = faqOpen === 2 ? null : 2">
                            What documents are required?
                        </button>
                        <div class="px-4 py-2" x-show="faqOpen === 2" style="display: none;">
                            <p class="text-gray-600">[Details about required documents]</p>
                        </div>
                    </div>
                    <div class="border-b border-gray-200 mb-4">
                        <button class="w-full text-left py-2 px-4 font-semibold text-gray-700 focus:outline-none"
                            @click="faqOpen = faqOpen === 3 ? null : 3">
                            What is the refund policy?
                        </button>
                        <div class="px-4 py-2" x-show="faqOpen === 3" style="display: none;">
                            <p class="text-gray-600">[Details about refund policy]</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
