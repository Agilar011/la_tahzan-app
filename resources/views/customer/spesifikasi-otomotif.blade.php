@extends('layouts.main')

@section('content')
<div class="container mx-auto sm:p-4 bg-gray-100 min-w-full">
    <div class="bg-white rounded-lg flex flex-col sm:p-2 lg:flex-row">
        <!-- Carousel -->
        <div class="w-full lg:w-2/3">
            <div class="grid gap-y-2">
                <div class="rounded-xl">
                    <img src="/img/produk otomotif 1.webp" alt="Gambar Utama" id="mainImage"
                        class="w-full h-96 object-cover rounded-xl">
                </div>
                <div class="flex flex-col gap-x-2 justify-center sm:flex-row sm:flex-wrap">
                    <div class="w-full sm:w-32">
                        <img src="/img/produk otomotif 1.webp" alt="Placeholder Image 1"
                            class="w-full h-40 object-cover thumbnail rounded-lg">
                    </div>
                    <div class="w-full sm:w-32">
                        <img src="/img/produk otomotif 2.webp" alt="Placeholder Image 2"
                            class="w-full h-40 object-cover thumbnail rounded-lg">
                    </div>
                    <div class="w-full sm:w-32">
                        <img src="/img/produk otomotif 3.webp" alt="Placeholder Image 3"
                            class="w-full h-40 object-cover thumbnail rounded-lg">
                    </div>

                    <div class="w-full sm:w-32">
                        <img src="/img/produk otomotif 4.webp" alt="Placeholder Image 4"
                            class="w-full h-40 object-cover thumbnail rounded-lg">
                    </div>
                    <div class="w-full sm:w-32">
                        <img src="/img/produk otomotif 4.webp" alt="Placeholder Image 5"
                            class="w-full h-40 object-cover thumbnail rounded-lg">
                    </div>
                    <div class="w-full sm:w-32">
                        <img src="/img/produk otomotif 4.webp" alt="Placeholder Image 6"
                            class="w-full h-40 object-cover thumbnail rounded-lg">
                    </div>
                </div>

            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const mainImage = document.getElementById('mainImage');
                    const thumbnails = document.querySelectorAll('.thumbnail');

                    thumbnails.forEach(thumbnail => {
                        thumbnail.addEventListener('click', () => {
                            const newSrc = thumbnail.src;
                            mainImage.src = newSrc;
                        });
                    });
                });

            </script>
        </div>

        <!-- Product Details -->
        <div class="w-full lg:w-1/2 lg:pl-8 ">
            <p class="block sm:hidden text-2xl text-gray-900 mb-4 font-bold">Rp. {{ number_format($otomotif->harga, 0, ',', '.') }}</p>
            <h1 class="text-4xl font-bold mb-4">{{ $otomotif->judul_produk }}</h1>
            <p class="text-2xl text-gray-900 mb-4 font-bold">Rp. {{ number_format($otomotif->harga, 0, ',', '.') }}</p>
            <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate rem quis sed assumenda voluptatum deleniti pariatur vel animi aliquid, quibusdam provident quia? Modi, officiis? Ea fuga porro quibusdam quidem omnis.</p>
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
            {{-- <div class="mb-4">
                <span class="bg-{{ $otomotif->status_ads == 'show' ? 'green' : 'red' }}-500 text-white px-3 py-1 rounded">
                    {{ ucfirst($otomotif->status_ads) }}
                </span>
                <span class="bg-{{ $otomotif->status_payment == 'paid' ? 'green' : ($otomotif->status_payment == 'expired' ? 'gray' : 'red') }}-500 text-white px-3 py-1 rounded">
                    {{ ucfirst($otomotif->status_payment) }}
                </span>
            </div> --}}
            <button class="px-4 py-2 text-white rounded" style="background-color: #25D366">
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
            <div class="flex w-1/3 justify-between divide-x-4">
                <!-- Div untuk jumlah produk -->
                <div class="text-center w-full">
                    <div class="flex items-center justify-center">
                        <i class="fa-solid fa-bag-shopping fa-2xl" style="color: #B197FC;"></i>
                        <p class="ml-2">{{ $otomotif->jumlahProduk }}</p>
                    </div>
                    <p class="mt-2">Jumlah Produk Dijual</p>
                </div>

                <!-- Div untuk lama bergabung -->
                <div class="text-center w-full">
                    <div class="flex items-center justify-center">
                        <i class="fa-solid fa-hourglass-start fa-2xl"></i>
                        <p class="ml-2">{{ $otomotif->sellerBergabung }}</p>
                    </div>
                    <p class="mt-2">Lama Bergabung</p>
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
