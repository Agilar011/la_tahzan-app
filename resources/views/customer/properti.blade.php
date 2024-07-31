@extends('layouts.main')

@section('content')
    <div class="grid mx-auto mt-10 md:flex">

        <!-- Sidebar -->
        <div id="sidebar" class="min-w-1/2 p-4 hidden">
            <span class="flex text-center items-center mb-5">
                <i class="fa-solid fa-filter mr-4"></i>
                <h2 class="text-2xl font-bold">Filter Product</h2>
            </span>
            <h2 class="text-xl font-bold mb-4">Filter by Price</h2>
            <form method="GET" action="{{ route('customer.properti.index') }}">
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

                <!-- Filter by Jenis Properti -->
                <div class="mb-4">
                    <h3 class="text-lg font-bold">Filter by Jenis Properti</h3>
                    @foreach ($jenis_properti as $jenis)
                        <div>
                            <input type="checkbox" id="jenis_{{ $jenis->id }}" name="jenis_properti[]" value="{{ $jenis->jenis_properti }}"
                                {{ in_array($jenis->jenis_properti, request('jenis_properti', [])) ? 'checked' : '' }}>
                            <label for="jenis_{{ $jenis->id }}">{{ $jenis->jenis_properti }}</label>
                        </div>
                    @endforeach
                </div>

                <!-- Filter by Kota -->
                <div class="mb-4">
                    <h3 class="text-lg font-bold">Filter by Kota</h3>
                    @foreach ($kota as $city)
                        <div>
                            <input type="checkbox" id="kota_{{ $city->id }}" name="kota[]" value="{{ $city->kota }}"
                                {{ in_array($city->kota, request('kota', [])) ? 'checked' : '' }}>
                            <label for="kota_{{ $city->id }}">{{ $city->kota }}</label>
                        </div>
                    @endforeach
                </div>

                <!-- Filter by Provinsi -->
                <div class="mb-4">
                    <h3 class="text-lg font-bold">Filter by Provinsi</h3>
                    @foreach ($provinsi as $province)
                        <div>
                            <input type="checkbox" id="provinsi_{{ $province->id }}" name="provinsi[]" value="{{ $province->provinsi }}"
                                {{ in_array($province->provinsi, request('provinsi', [])) ? 'checked' : '' }}>
                            <label for="provinsi_{{ $province->id }}">{{ $province->provinsi }}</label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="px-4 py-2 bg-slate-800 text-white rounded">Apply</button>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="mb-8 p-1 sm:flex-1 p-4">
            <div class="flex justify-between text-center">
                <h1 class="text-4xl font-bold">Etalase Properti</h1>
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
                @foreach ($properti as $properti)
                    <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                        <a href="{{ route('properti.spesifikasi', $properti->id) }}">
                            @foreach ($properti->fotos as $foto)
                                <img src="{{ asset('storage/foto_properti/' . $foto->path) }}" alt="{{ $properti->judul_produk }}"
                                    class="w-full h-40 object-cover">
                                @break <!-- Show only the first photo -->
                            @endforeach
                            <div class="p-2 md:p-4">
                                <p class="font-bold text-lg md:text-xl">Rp. {{ number_format($properti->harga, 0, ',', '.') }}</p>
                                <h2 class="mt-4 text-lg md:text-xl">{{ $properti->judul_produk }}</h2>
                                <p class="mt-1 text-gray-500">{{ $properti->spesifikasi->alamat }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            {{-- <div class="mt-8">
            {{ $properti->appends(request()->input())->links() }}
        </div> --}}
        </div>
    </div>
@endsection
