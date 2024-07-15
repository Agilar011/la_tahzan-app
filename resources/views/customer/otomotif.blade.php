@extends('layouts.main')

@section('content')
<div class="mx-auto flex mt-10">


    <!-- Sidebar -->
    <div id="sidebar" class="w-2/12 p-4">
        <h2 class="text-xl font-bold mb-4">Filter by Price</h2>
        <form method="GET" action="{{ route('customer.otomotif.index') }}">
            <div class="mb-4">
                <label for="min_price" class="block text-gray-700">Min Price</label>
                <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}" class="w-full px-4 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="max_price" class="block text-gray-700">Max Price</label>
                <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}" class="w-full px-4 py-2 border rounded">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Apply</button>
        </form>
    </div>

     <!-- Toggle Button -->
     {{-- <div class="p-4">
        <button id="toggleSidebar" class="px-4 py-2 bg-slate-800 text-white rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div> --}}

    <!-- Products Grid -->
    <div class="flex-1 p-4">
        <h1 class="text-4xl font-bold mb-8">Etalase Otomotif</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-center">
            @foreach($otomotif as $product)
            <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
                <a href="{{ route('customer.otomotif.spesifikasi', $product->id) }}">
                    <img src="/img/produk otomotif 1.webp" alt="{{ $product->judul_produk }}" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <p class="font-bold text-xl">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
                        <h2 class="mt-4 text-xl">{{ $product->judul_produk }}</h2>
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
