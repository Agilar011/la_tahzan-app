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
            <form method="GET" action="{{ route('customer.umrah.index') }}">
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

                <!-- Filter by Agen Travel -->
                <div class="mb-4">
                    <h3 class="text-lg font-bold">Filter by Agen Travel</h3>
                    @foreach ($agen_travel as $agen)
                        <div>
                            <input type="checkbox" id="agen_travel_{{ $agen->agen_travel }}" name="agen_travel[]"
                                value="{{ $agen->agen_travel }}"
                                {{ in_array($agen->agen_travel, request('agen_travel', [])) ? 'checked' : '' }}>
                            <label for="agen_travel_{{ $agen->agen_travel }}">{{ $agen->agen_travel }}</label>
                        </div>
                    @endforeach
                </div>

                <!-- Filter by Durasi -->
                <div class="mb-4">
                    <h3 class="text-lg font-bold">Filter by Durasi</h3>
                    @foreach ($durasi as $dur)
                        <div>
                            <input type="checkbox" id="durasi_{{ $dur->durasi }}" name="durasi[]" value="{{ $dur->durasi }}"
                                {{ in_array($dur->durasi, request('durasi', [])) ? 'checked' : '' }}>
                            <label for="durasi_{{ $dur->durasi }}">{{ $dur->durasi }} hari</label>
                        </div>
                    @endforeach
                </div>

                <!-- Filter by Maskapai -->
                <div class="mb-4">
                    <h3 class="text-lg font-bold">Filter by Maskapai</h3>
                    @foreach ($maskapai as $mask)
                        <div>
                            <input type="checkbox" id="maskapai_{{ $mask->maskapai }}" name="maskapai[]"
                                value="{{ $mask->maskapai }}"
                                {{ in_array($mask->maskapai, request('maskapai', [])) ? 'checked' : '' }}>
                            <label for="maskapai_{{ $mask->maskapai }}">{{ $mask->maskapai }}</label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="px-4 py-2 bg-slate-800 text-white rounded">Apply</button>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="mb-8 p-1 sm:flex-1 p-4">
            <div class="flex justify-between text-center">
                <h1 class="text-4xl font-bold">Etalase Umrah</h1>
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
                @foreach ($umrah as $product)
                    <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                        <a href="{{ route('umrah.spesifikasi', $product->id) }}">
                            @if($product->fotos->isNotEmpty())
                                <img src="{{ asset('storage/foto_umrah/' . $product->fotos->first()->path) }}" alt="{{ $product->judul_produk }}" class="w-full h-40 object-cover">
                            @else
                                <img src="/img/default.jpg" alt="{{ $product->judul_produk }}" class="w-full h-40 object-cover">
                            @endif
                            <div class="p-2 md:p-4">
                                <p class="font-bold text-lg md:text-xl">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
                                <h2 class="mt-4 text-lg md:text-xl">{{ $product->judul_produk }}</h2>
                                <p class="mt-1 text-gray-500">{{ $product->spesifikasi->agen_travel }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            {{-- <div class="mt-8">
            {{ $umrah->appends(request()->input())->links() }}
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
