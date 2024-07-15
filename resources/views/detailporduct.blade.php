@extends('layouts.main')

@section('content')
    {{-- Section 3 Product --}}
    <div class="flex flex-wrap justify-center w-11/12 mx-auto">
        <div class="flex flex-col bg-cover bg-center"
            style="background-image: url('/img/thumbnail umrah.png'); min-width: 33.33%;">
            <div class="bg-black bg-opacity-50 text-white text-center min-h-[470px] flex flex-col justify-between">
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

        <div class="flex flex-col bg-cover bg-center"
            style="background-image: url('/img/thumbnail otomotif.jpg'); min-width: 33.33%;">
            <div class="bg-black bg-opacity-50 text-white text-center min-h-[470px] flex flex-col justify-between">
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

        <div class="flex flex-col bg-cover bg-center"
            style="background-image: url('/img/thumbnail property.webp'); min-width: 33.33%;">
            <div class="bg-black bg-opacity-50 text-white text-center min-h-[470px] flex flex-col justify-between">
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

        <div class="flex flex-wrap justify-center mt-8">
            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden m-4">
                <img src="/img/produk umroh 1.jpg" alt="Umrah Package" class="w-full h-64 object-contain cursor-pointer"
                    id="thumbnail1">
                <a href="#">
                    <div class="p-6">
                        <h2 class="font-bold text-xl">Umrah Package 1</h2>
                        <p class="mt-4 text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet
                            libero eros.</p>
                    </div>
                </a>
            </div>

            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden m-4">
                <img src="/img/produk umroh 2.jpg" alt="Umrah Package" class="w-full h-64 object-cover cursor-pointer"
                    id="thumbnail2">
                <a href="#">
                    <div class="p-6">
                        <h2 class="font-bold text-xl">Umrah Package 2</h2>
                        <p class="mt-4 text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet
                            libero eros.</p>
                    </div>
                </a>
            </div>

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

        <div class="w-11/12 mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="/img/produk otomotif 1.webp" alt="Automotive Product"
                    class="w-full h-64 object-cover cursor-pointer" id="thumbnail3">
                <div class="p-6">
                    <h2 class="font-bold text-xl">Automotive Product 1</h2>
                    <p class="mt-4 text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet
                        libero eros.</p>
                </div>
            </div>

            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="/img/produk otomotif 2.webp" alt="Automotive Product"
                    class="w-full h-64 object-cover cursor-pointer" id="thumbnail4">
                <div class="p-6">
                    <h2 class="font-bold text-xl">Automotive Product 2</h2>
                    <p class="mt-4 text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet
                        libero eros.</p>
                </div>
            </div>

            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="/img/produk otomotif 3.webp" alt="Automotive Product"
                    class="w-full h-64 object-cover cursor-pointer" id="thumbnail5">
                <div class="p-6">
                    <h2 class="font-bold text-xl">Automotive Product 3</h2>
                    <p class="mt-4 text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet
                        libero eros.</p>
                </div>
            </div>

            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="/img/produk otomotif 4.webp" alt="Automotive Product"
                    class="w-full h-64 object-cover cursor-pointer" id="thumbnail6">
                <div class="p-6">
                    <h2 class="font-bold text-xl">Automotive Product 4</h2>
                    <p class="mt-4 text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet
                        libero eros.</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center mt-8">
            <a href="#" class="px-4 py-2 bg-slate-800 rounded-lg text-white hover:bg-slate-400 hover:text-black ">
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

        <div class="w-11/12 mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="/img/produk property 1.webp" alt="Property Product"
                    class="w-full h-64 object-cover cursor-pointer" id="thumbnail7">
                <div class="p-6">
                    <h2 class="font-bold text-xl">Property Product 1</h2>
                    <p class="mt-4 text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet
                        libero eros.</p>
                </div>
            </div>

            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="/img/produk property 2.webp" alt="Property Product"
                    class="w-full h-64 object-cover cursor-pointer" id="thumbnail8">
                <div class="p-6">
                    <h2 class="font-bold text-xl">Property Product 2</h2>
                    <p class="mt-4 text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet
                        libero eros.</p>
                </div>
            </div>

            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="/img/produk property 3.webp" alt="Property Product"
                    class="w-full h-64 object-cover cursor-pointer" id="thumbnail9">
                <div class="p-6">
                    <h2 class="font-bold text-xl">Property Product 3</h2>
                    <p class="mt-4 text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet
                        libero eros.</p>
                </div>
            </div>

            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="/img/produk property 4.webp" alt="Property Product"
                    class="w-full h-64 object-cover cursor-pointer" id="thumbnail10">
                <div class="p-6">
                    <h2 class="font-bold text-xl">Property Product 4</h2>
                    <p class="mt-4 text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet
                        libero eros.</p>
                </div>
            </div>

        </div>

        <div class="flex flex-col items-center justify-center mt-8">
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
