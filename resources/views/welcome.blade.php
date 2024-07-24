@extends('layouts.main')

@section('content')
{{-- Section Carousel --}}
<style>
    .carousel {
        display: flex;
        width: 100%;
        height: 60%; /* Atur tinggi carousel sesuai kebutuhan */
    }
    .carousel-item {
        min-width: 100%;
        transition: transform 0.5s ease-in-out;
    }
</style>

<div class="relative">
    <div class="carousel" id="carousel">
        <div class="carousel-item flex justify-center">
            <img src="/img/thumbnail otomotif.jpg" alt="Image 1" class="w-auto h-[500px] object-cover sm::object-contain">
        </div>
        <div class="carousel-item flex justify-center">
            <img src="/img/thumbnail umrah.jpg" alt="Placeholder Image 2" class="w-auto h-[500px] object-cover sm::object-contain">
        </div>
        <div class="carousel-item flex justify-center">
            <img src="/img/thumbnail otomotif.jpg" alt="Image 3" class="w-auto h-[500px] object-cover sm::object-contain">
        </div>
        <div class="carousel-item flex justify-center">
            <img src="/img/thumbnail umrah.jpg" alt="Image 4" class="w-auto h-[500px] object-cover sm::object-contain">
        </div>
        <div class="carousel-item flex justify-center">
            <img src="/img/thumbnail otomotif.jpg" alt="Image 5" class="w-auto h-[500px] object-cover sm::object-contain">
        </div>
    </div>

    <button class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2" id="prev">&lt;</button>
    <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2" id="next">&gt;</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const carousel = document.getElementById('carousel');
        const carouselItems = document.querySelectorAll('.carousel-item');
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');
        let currentIndex = 0;

        function updateCarousel() {
            const offset = -currentIndex * 100;
            carousel.style.transform = `translateX(${offset}%)`;
            console.log(`updateCarousel called. Current Index: ${currentIndex}, Offset: ${offset}%`);
        }

        function showNextImage() {
            console.log("showNextImage called. Current Index:", currentIndex);
            if (currentIndex < carouselItems.length - 1) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateCarousel();
            console.log("Next Image Shown. Updated Current Index:", currentIndex);
        }

        prevButton.addEventListener('click', () => {
            console.log("Prev button clicked. Current Index:", currentIndex);
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = carouselItems.length - 1;
            }
            updateCarousel();
            console.log("Previous Image Shown. Updated Current Index:", currentIndex);
        });

        nextButton.addEventListener('click', showNextImage);

        setInterval(showNextImage, 5000); // Change image every 5 seconds

        updateCarousel();
    });
</script>


    {{-- Section 3 Product --}}
    <div class="w-full sm:grid w-1/2 md:flex flex-wrap justify-center w-11/12 mx-auto mt-10">
        <div class="my-2 md:flex flex-col bg-cover bg-center mx-2 "
            style="background-image: url('/img/thumbnail umrah.jpg'); min-width: 30%;">
            <div class="bg-black bg-opacity-50 text-white text-center min-h-[210px] flex flex-col justify-between">
                <div class="mt-auto mb-11 py-8">
                    <h1 class="mb-0 font-bold">Umrah Packages</h1>
                </div>
                <div class="mt-auto py-8">
                    <a class="bg-white text-black px-4 py-2 rounded hover:bg-gray-200 transition duration-300"
                        href="shop.html">
                        Explore Packages <i class="fe fe-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="my-2 flex flex-col bg-cover bg-center mx-2 "
            style="background-image: url('/img/thumbnail otomotif.jpg'); min-width: 30%;">
            <div class="bg-black bg-opacity-50 text-white text-center min-h-[200px] flex flex-col justify-between">
                <div class="mt-auto mb-11 py-8">
                    <h1 class="mb-0 font-bold">Etalase Otomotif</h1>
                </div>
                <div class="mt-auto py-8">
                    <a class="bg-white text-black px-4 py-2 rounded hover:bg-gray-200 transition duration-300"
                        href="shop.html">
                        Explore Etalase <i class="fe fe-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>


        <div class="my-2 flex flex-col bg-cover bg-center mx-2"
            style="background-image: url('/img/thumbnail property.webp'); min-width: 30%;">
            <div class="bg-black bg-opacity-50 text-white text-center min-h-[200px] flex flex-col justify-between">
                <div class="mt-auto mb-11 py-8">
                    <h1 class="mb-0 font-bold">Etalase Property</h1>
                </div>
                <div class="mt-auto py-8">
                    <a class="bg-white text-black px-4 py-2 rounded hover:bg-gray-200 transition duration-300"
                        href="shop.html">
                        Explore Etalase <i class="fe fe-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Section Umrah --}}
    <div>
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-4xl font-bold mt-16">Umrah Packages</h1>
            <p class="text-gray-500 text-center mt-4">Choose the best Umrah package that suits your needs</p>
        </div>

        <div class="flex flex-wrap justify-center mt-8 ">
            @foreach ($umrah as $item)
            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden m-4 w-full md:w-1/3 lg:w-1/4 ">
                <img src="/img/produk umroh 1.jpg" alt="Umrah Package" class="w-full h-64 object-contain cursor-pointer" id="thumbnail1">
                <a href="#">
                    <div class="p-6">
                        <h2 class="font-black text-xl">Rp. {{ number_format($item->harga, 0, ',', '.') }}</h2>
                        <p class="mt-2 text-xl">{{ $item->judul_produk}}</p>
                        <p class="mt-2 text-gray-500 text-xl">{{ $item->deskripsi_produk}}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="flex flex-col items-center justify-center mt-8">
            <a href="#" class="px-4 py-2 bg-slate-800 rounded-lg text-white hover:bg-slate-400 hover:text-black ">
                <h1 class="text-xl font-bold ">Etalase Umrah</h1>
            </a>
            {{-- <p class="text-gray-500 text-center mt-4">Choose the best property products that suit your needs</p> --}}
        </div>




    </div>

    {{-- Section Otomotif --}}
    <div>
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-4xl font-bold mt-16">Etalase Otomotif</h1>
            <p class="text-gray-500 text-center mt-4">Choose the best automotive products that suit your needs</p>
        </div>

        <div>


        </div>

        <div class="w-11/12 mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-8">
            @foreach ($otomotif as $item)
            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="/img/produk otomotif 1.webp" alt="Automotive Product"
                class="w-full h-64 object-cover cursor-pointer" id="thumbnail3">
                <div class="p-6">
                    <h2 class="font-black text-xl">Rp. {{ number_format($item->harga, 0, ',', '.') }}</h2>
                    <p class="mt-2 text-lg">{{ $item->judul_produk}}</p>
                </div>
                </div>
                @endforeach

        </div>

        <div class="flex flex-col items-center justify-center mt-8">
            <a href="{{ route('otomotif.index') }}"

                class="px-4 py-2 bg-slate-800 text-white rounded-lg hover:bg-slate-400 transition duration-300 hover:text-black">

                <h1 class="text-xl font-bold ">Etalase Otomotif</h1>
            </a>
            {{-- <p class="text-gray-500 text-center mt-4">Choose the best property products that suit your needs</p> --}}
        </div>
    </div>

    {{-- Section Property --}}
    <div>
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-4xl font-bold mt-16">Etalase Property</h1>
            <p class="text-gray-500 text-center mt-4">Choose the best property products that suit your needs</p>
        </div>

        <div class="w-11/12 mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-8">
            @foreach ($property as $item)
            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="/img/produk property 1.webp" alt="Property Product"
                class="w-full h-64 object-cover cursor-pointer" id="thumbnail7">
                <div class="p-6">
                    <h2 class="font-black text-xl">Rp. {{ number_format($item->harga, 0, ',', '.') }}</h2>
                    <p class="mt-2 text-lg">{{ $item->judul_produk}}</p>
                    </div>
                </div>
                @endforeach

            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="/img/produk property 2.webp" alt="Property Product"
                    class="w-full h-64 object-cover cursor-pointer" id="thumbnail8">
                <div class="p-6">
                    <h2 class="font-bold text-xl">Property Product 2</h2>
                    <p class="mt-4 text-gray-500">Lorem ipsum dolor sit.</p>
                </div>
            </div>

            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="/img/produk property 3.webp" alt="Property Product"
                    class="w-full h-64 object-cover cursor-pointer" id="thumbnail9">
                <div class="p-6">
                    <h2 class="font-bold text-xl">Property Product 3</h2>
                    <p class="mt-4 text-gray-500">Lorem ipsum dolor sit.</p>
                </div>
            </div>



        </div>

        <div class="flex flex-col items-center justify-center my-8">
            <a href="#" class="px-4 py-2 bg-slate-800 rounded-lg text-white hover:bg-slate-400 hover:text-black ">
                <h1 class="text-xl font-bold ">Etalase Property</h1>
            </a>
            {{-- <p class="text-gray-500 text-center mt-4">Choose the best property products that suit your needs</p> --}}
        </div>
    </div>



    <!-- Modal -->
    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 hidden">
        <div class="relative max-w-full max-h [90vh]">
            <img id="modalImage" src="" alt="Modal Image" class="max-w-full max-h-[90vh] object-contain">
            <button id="closeModal"
                class="absolute top-4 right-4 text-white bg-red-500 rounded-full p-2 hover:bg-red-600 transition duration-300">&times;</button>
        </div>
    </div>



    <script>
        const thumbnails = document.querySelectorAll('[id^="thumbnail"]');
        const modal = document.getElementById('modal');
        const modalImage = document.getElementById('modalImage');
        const closeModal = document.getElementById('closeModal');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', () => {
                modalImage.src = thumbnail.src;
                modal.classList.remove('hidden');
            });
        });

        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>
@endsection
