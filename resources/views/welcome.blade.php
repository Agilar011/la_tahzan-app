@extends('layouts.main')

@section('content')
    {{-- Section Carousel --}}
    <style>
        .carousel-item {
            display: none;
            /* height: 100%; */
            border-radius: 10px;
        }

        .carousel-container {
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

        .prev,
        .next {
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
                <a href="{{ route('umrah.spesifikasi', $item->id) }}">
                    <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden m-4 w-full md:w-1/3 lg:w-1/4 ">
                        @foreach ($item->fotos as $foto)
                            <img src="{{ asset('storage/foto_umrah/' . $foto->path) }}" alt="{{ $item->judul_produk }}"
                                class="w-full h-72 object-cover">
                        @break

                        <!-- Show only the first photo -->
                    @endforeach
                    <div class="p-6">
                        <h2 class="font-black text-xl">Rp. {{ number_format($item->harga, 0, ',', '.') }}</h2>
                        <p class="mt-2 text-xl">{{ $item->judul_produk }}</p>
                        <p class="mt-2 text-gray-500 text-xl">{{ $item->deskripsi_produk }}</p>
                    </div>
            </a>
                    </div>
    @endforeach
</div>
<div class="flex flex-col items-center justify-center mt-8">
    <a href="{{ route('umrah.index') }}"
        class="px-4 py-2 bg-slate-800 rounded-lg text-white hover:bg-slate-400 hover:text-black ">
        <h1 class="text-xl font-bold ">Etalase Umrah</h1>
    </a>
    {{-- <p class="text-gray-500 text-center mt-4">Choose the best property products that suit your needs</p> --}}
</div>




{{-- Otomotif Section --}}
<div>
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-4xl font-bold mt-16">Etalase Otomotif</h1>
        <p class="text-gray-500 text-center mt-4">Choose the best automotive products that suit your needs</p>
    </div>

    <div class="w-11/12 mx-auto grid grid-cols-2 mt-8 gap-2 md:gap-4 md:grid-cols-3 lg:grid-cols-4">
        @foreach ($otomotif as $item)
            <div class="relative flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Badge for Star Seller or VIP -->
                @if ($item->spesifikasi->status_seller == '2Star Seller')
                    <div class="absolute top-0 right-0 bg-orange-500 text-white p-2 rounded-bl-lg flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 17.27l5.18 3.73-1.64-5.81 4.82-3.97-6.1-.47L12 2l-2.26 8.75-6.1.47 4.82 3.97-1.64 5.81L12 17.27z">
                            </path>
                        </svg>
                        <span>Star Seller</span>
                    </div>
                @elseif ($item->spesifikasi->status_seller == '1VIP')
                    <div class="absolute top-0 right-0 bg-purple-500 text-white p-2 rounded-bl-lg flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 21h14M9 18v-3a3 3 0 016 0v3"></path>
                        </svg>
                        <span>VIP</span>
                    </div>
                @endif

                <a href="{{ route('otomotif.spesifikasi', $item->id) }}">
                    @foreach ($item->fotos as $foto)
                        <img src="{{ asset('storage/foto_otomotif/' . $foto->path) }}" alt="{{ $item->judul_produk }}"
                            class="w-full h-64 object-cover">
                    @break

                    <!-- Show only the first photo -->
                @endforeach
                <div class="p-6 relative">
                    <h2 class="font-black text-xl">Rp. {{ number_format($item->harga, 0, ',', '.') }}</h2>
                    <p class="mt-2 text-lg">{{ Str::limit($item->judul_produk, 32, '...') }}</p>
                    <p class="mt-2 text-lg">{{ date('Y', strtotime($item->spesifikasi->tahun_pembuatan)) }}</p>
                    <div class="absolute bottom-4 right-4 flex items-center text-gray-500">
                        <img src="{{ asset('logooto/mitsubishi.png') }}" alt="Logo" class="w-4 h-4 mr-1">
                        <p>{{ $item->spesifikasi->brand }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
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

<div class="w-11/12 mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1 mt-8">
    @foreach ($properti as $item)
        <div class="relative flex flex-col bg-white shadow-lg rounded-sm overflow-hidden">
            <!-- Badge for Star Seller or VIP -->
            @if ($item->spesifikasi->status_seller == 'Star Seller')
                <div class="absolute top-0 right-0 bg-orange-500 text-white p-2 rounded-bl-lg flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 17.27l5.18 3.73-1.64-5.81 4.82-3.97-6.1-.47L12 2l-2.26 8.75-6.1.47 4.82 3.97-1.64 5.81L12 17.27z">
                        </path>
                    </svg>
                    <span>Star Seller</span>
                </div>
            @elseif ($item->spesifikasi->status_seller == 'VIP')
                <div class="absolute top-0 right-0 bg-purple-500 text-white p-2 rounded-bl-lg flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 21h14M9 18v-3a3 3 0 016 0v3"></path>
                    </svg>
                    <span>VIP</span>
                </div>
            @endif

            <a href="{{ route('properti.spesifikasi', $item->id) }}">
                @foreach ($item->fotos as $foto)
                    <img src="{{ asset('storage/foto_properti/' . $foto->path) }}"
                        alt="{{ $item->judul_produk }}" class="w-full h-64 object-cover">
                @break

                <!-- Show only the first photo -->
            @endforeach

            <div class="p-6">
                <h2 class="font-black text-xl">Rp. {{ number_format($item->harga, 0, ',', '.') }}</h2>
                <p class="mt-2 text-lg">{{ $item->judul_produk }}</p>
                <div class="flex items-center text-gray-500 mt-2">
                    <img src="{{ asset('loc.png') }}" alt="Logo" class="h-4 mr-1">
                    <p class="text-sm">{{ $item->spesifikasi->kota }}, {{ $item->spesifikasi->provinsi }}</p>
                </div>
            </div>
        </a>
    </div>
@endforeach
</div>
</div>

</div>

<div class="flex flex-col items-center justify-center my-8">
<a href="{{ route('properti.index') }}"
class="px-4 py-2 bg-slate-800 rounded-lg text-white hover:bg-slate-400 hover:text-black ">
<h1 class="text-xl font-bold ">Etalase Properti</h1>
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
