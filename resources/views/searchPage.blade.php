@extends('layouts.main')

@section('content')
    <div class="grid mx-auto mt-10 md:flex">
        <!-- Sidebar -->
        {{-- <div id="sidebar" class="min-w-1/2 p-4 hidden ">
            <span class="flex text-center items-center mb-5 ">
                <i class="fa-solid fa-filter mr-4"></i>
                <h2 class="text-2xl font-bold">Filter Product</h2>
            </span>
            <h2 class="text-xl font-bold mb-4">Filter by Price</h2>
            <form method="GET" action="{{ route('customer.otomotif.index') }}">
                <div class="mb-4">
                    <label for="min_price" class="block text-gray-700">Min Price</label>
                    <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}"
                        class="w-full px-4 py-2 border rounded">
                </div>
                <div class="mb-4">
                    <label for="max_price" class="block text-gray-700">Max Price</label>
                    <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}"
                        class="w-full px-4 py-2 border rounded">
                </div>

                <!-- Filter by brand -->
                <div class="mb-4">
                    <h3 class="text-lg font-bold">Filter by Brand</h3>
                    @foreach ($brand as $brand)
                        <div>
                            <input type="checkbox" id="brand_{{ $brand->id }}" name="brands[]"
                                value="{{ $brand->id }}"
                                {{ in_array($brand->id, request('brands', [])) ? 'checked' : '' }}>
                            <label for="brand_{{ $brand->id }}">{{ $brand->brand }}</label>
                        </div>
                    @endforeach
                </div>

                <!-- Filter by Jenis -->
                <div class="mb-4">
                    <h3 class="text-lg font-bold">Filter by Jenis</h3>
                    @foreach ($type as $j)
                        <div>
                            <input type="checkbox" id="type_{{ $j->id }}" name="type[]" value="{{ $j->id }}"
                                {{ in_array($j->id, request('type', [])) ? 'checked' : '' }}>
                            <label for="type_{{ $j->id }}">{{ $j->type }}</label>
                        </div>
                    @endforeach
                </div>

                <!-- Filter by Subjenis -->
                <div class="mb-4">
                    <h3 class="text-lg font-bold">Filter by Subjenis</h3>
                    @foreach ($subtype as $sj)
                        <div>
                            <input type="checkbox" id="subtype_{{ $sj->id }}" name="subtype[]"
                                value="{{ $sj->id }}"
                                {{ in_array($sj->id, request('subtype', [])) ? 'checked' : '' }}>
                            <label for="subtype_{{ $sj->id }}">{{ $sj->subtype }}</label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="px-4 py-2 bg-slate-800 text-white rounded">Apply</button>
            </form>
        </div> --}}

        <!-- Products Grid -->
        <div class="mb-8 p-1 sm:flex-1 p-4">
            <div class="flex justify-between text-center">
                <h1 class="text-4xl font-bold">Etalase Produk</h1>
                <button class="toggle-button" id="toggleButton">
                    <i id="toggleOff" class="fa-solid fa-toggle-off fa-2xl"></i>
                    <i id="toggleOn" class="hidden fa-solid fa-toggle-on fa-2xl"></i>
                </button>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const sidebar = document.getElementById('sidebar');
                    const button = document.getElementById('toggleOff');
                    const button2 = document.getElementById('toggleOn');

                    const toggleButton = document.getElementById('toggleButton');

                    toggleButton.addEventListener('click', () => {
                        if (sidebar.style.display === 'block') {
                            sidebar.style.display = 'none';
                            button.style.display = 'block';
                            button2.style.display = 'none';
                        } else {
                            sidebar.style.display = 'block';
                            button.style.display = 'none';
                            button2.style.display = 'block';
                        }
                    });
                });
            </script>

            <div class="grid grid-cols-2 gap-1 lg:grid-cols-3 xl:grid-cols-4 xl:gap-4 mt-8">
                @foreach ($results as $item)
                    @if ($item->jenis_produk == 'otomotif')
                        <div class="relative flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                            <!-- Badge for Star Seller or VIP -->
                            @if ($item->otomotif->status_seller == '2Star Seller')
                                <div
                                    class="absolute top-0 right-0 bg-orange-500 text-white p-2 rounded-bl-lg flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 17.27l5.18 3.73-1.64-5.81 4.82-3.97-6.1-.47L12 2l-2.26 8.75-6.1.47 4.82 3.97-1.64 5.81L12 17.27z">
                                        </path>
                                    </svg>
                                    <span>Star Seller</span>
                                </div>
                            @elseif ($item->otomotif->status_seller == '1VIP')
                                <div
                                    class="absolute top-0 right-0 bg-purple-500 text-white p-2 rounded-bl-lg flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 21h14M9 18v-3a3 3 0 016 0v3"></path>
                                    </svg>
                                    <span>VIP</span>
                                </div>
                            @endif

                            <a href="{{ route('otomotif.spesifikasi', $item->id_otomotif) }}">

                                <img src="{{ asset('storage/foto_otomotif/' . $item->pathOto) }}"
                                    alt="{{ $item->judul_produk }}" class="w-full h-64 object-cover">

                                <div class="p-6 relative">
                                    <h2 class="font-black text-xl">Rp.
                                        {{ number_format($item->otomotif->harga, 0, ',', '.') }}</h2>
                                    <p class="mt-2 text-lg">{{ Str::limit($item->judul_produk, 32, '...') }}</p>
                                    <p class="mt-2 text-lg">
                                        {{ date('Y', strtotime($item->spesifikasiotomotif->tahun_pembuatan)) }}
                                    </p>
                                    <div class="absolute bottom-4 right-4 flex items-center text-gray-500">
                                        <img src="{{ asset('logooto/mitsubishi.png') }}" alt="Logo"
                                            class="w-4 h-4 mr-1">
                                        <p>{{ $item->spesifikasiotomotif->brand }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @elseif ($item->jenis_produk == 'properti')
                        <div class="relative flex flex-col bg-white shadow-lg rounded-sm overflow-hidden">
                            <!-- Badge for Star Seller or VIP -->
                            @if ($item->spesifikasiproperti->status_seller == 'Star Seller')
                                <div
                                    class="absolute top-0 right-0 bg-orange-500 text-white p-2 rounded-bl-lg flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 17.27l5.18 3.73-1.64-5.81 4.82-3.97-6.1-.47L12 2l-2.26 8.75-6.1.47 4.82 3.97-1.64 5.81L12 17.27z">
                                        </path>
                                    </svg>
                                    <span>Star Seller</span>
                                </div>
                            @elseif ($item->properti->status_seller == 'VIP')
                                <div
                                    class="absolute top-0 right-0 bg-purple-500 text-white p-2 rounded-bl-lg flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 21h14M9 18v-3a3 3 0 016 0v3"></path>
                                    </svg>
                                    <span>VIP</span>
                                </div>
                            @endif

                            <a href="{{ route('properti.spesifikasi', $item->id_properti) }}">
                                {{-- @if ($item->fotos->isNotEmpty())
                                    <img src="{{ asset('storage/foto_properti/' . $item->fotos->first()->path) }}"
                                        alt="{{ $item->judul_produk }}" class="w-full h-64 object-cover">
                                @endif --}}
                                <div class="p-6">
                                    <h2 class="font-black text-xl">Rp.
                                        {{ number_format($item->properti->harga, 0, ',', '.') }}</h2>
                                    <p class="mt-2 text-lg">{{ $item->judul_produk }}</p>
                                    <div class="flex items-center text-gray-500 mt-2">
                                        <img src="{{ asset('loc.png') }}" alt="Logo" class="h-4 mr-1">
                                        <p class="text-sm">{{ $item->spesifikasiProperti->kota }},
                                            {{ $item->spesifikasiProperti->provinsi }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <a href="{{ route('umrah.spesifikasi', $item->id) }}">
                            <div
                                class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden m-4 w-full md:w-1/3 lg:w-1/4">
                                {{-- @if ($item->fotos->isNotEmpty())
                                    <img src="{{ asset('storage/foto_umrah/' . $item->fotos->first()->path) }}"
                                        alt="{{ $item->judul_produk }}" class="w-full h-72 object-cover">
                                @endif --}}
                                <div class="p-6">
                                    <h2 class="font-black text-xl">Rp. {{ number_format($item->harga, 0, ',', '.') }}</h2>
                                    <p class="mt-2 text-xl">{{ $item->judul_produk }}</p>
                                    <p class="mt-2 text-gray-500 text-xl">{{ $item->deskripsi_produk }}</p>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
            {{-- <div class="mt-8">
                {{ $otomotif->appends(request()->input())->links() }}
            </div> --}}
        </div>
    </div>

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
            } else {
                sidebar.classList.add('hidden');
            }
        });
    </script>
@endsection
