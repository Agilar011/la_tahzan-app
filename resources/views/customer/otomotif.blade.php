@extends('layouts.main')

@section('content')
    <div class="grid mx-auto mt-10 md:flex">

        <!-- Sidebar -->
        <div id="sidebar" class="min-w-1/2 p-4 hidden ">
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
                            <input type="checkbox" id="brand_{{ $brand->id }}" name="brands[]" value="{{ $brand->id }}"
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


        </div>

        <!-- Products Grid -->
        <div class="mb-8 p-1 sm:flex-1 p-4">
            <div class="flex justify-between text-center">
                <h1 class="text-4xl font-bold">Etalase Otomotif</h1>
                <button class="toggle-button" id="toggleButton">
                    <i id="toggleOff" class=" fa-solid fa-toggle-off fa-2xl"></i>
                    <i id="toggleOn" class=" hidden fa-solid fa-toggle-on fa-2xl"></i>
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
                            // toggleButton.textContent = 'Show Sidebar';
                        } else {
                            sidebar.style.display = 'block';
                            button.style.display = 'none';
                            button2.style.display = 'block';
                            // toggleButton.textContent = 'Hide Sidebar';
                        }
                    });
                });
            </script>

            <div class="grid grid-cols-2 gap-1 lg:grid-cols-3 xl:grid-cols-4 xl:gap-4 mt-8">
                @foreach ($otomotif as $product)
                    <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                        <a href="{{ route('otomotif.spesifikasi', $product->id) }}">
                            <img src="/img/produk otomotif 1.webp" alt="{{ $product->judul_produk }}"
                                class="w-full h-40 object-cover">
                            <div class="p-2 md:p-4">
                                <p class="font-bold text-lg md:text-xl">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
                                <h2 class="mt-4text-lg md:text-xl">{{ $product->judul_produk }}</h2>
                                <p class="mt-1 text-gray-500">{{ $product->deskripsi_produk }}</p>
                            </div>
                        </a>
                    </div>
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
