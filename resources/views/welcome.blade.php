@extends('layouts.main')

@section('content')
{{-- Section Carousel --}}
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

<div class="carousel-container min-h-full">
    <img src="/img/produk otomotif 1.webp" alt="Placeholder Image 1" class="carousel-item active">
    <img src="/img/produk otomotif 2.webp" alt="Placeholder Image 2" class="carousel-item">
    <img src="/img/produk otomotif 3.webp" alt="Placeholder Image 3" class="carousel-item">
    <img src="/img/produk otomotif 4.webp" alt="Placeholder Image 4" class="carousel-item">
    <div class="button-container">
        <button class="prev" id="prev">&#10094;</button>
        <button class="next" id="next">&#10095;</button>
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


    {{-- Section 3 Product --}}
    <div class="w-full md:flex flex-wrap justify-center w-11/12 mx-auto mt-10">
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

        <div class="w-11/12 mx-auto grid grid-cols-2 mt-8 gap-2 md:gap-4 md:grid-cols-3 lg:grid-cols-4 ">
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
