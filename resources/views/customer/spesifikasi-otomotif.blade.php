@extends('layouts.main')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex">
        <div class="w-1/2">
            <img src="/img/produk otomotif 1.webp" alt="{{ $otomotif->judul_produk }}" class="w-full h-96 object-cover">
        </div>
        <div class="w-1/2 p-4">
            <h1 class="text-4xl font-bold mb-4">{{ $otomotif->judul_produk }}</h1>
            <p class="text-gray-700 mb-4">{{ $otomotif->deskripsi_produk }}</p>
            <p class="text-2xl text-gray-900 mb-4">Rp. {{ number_format($otomotif->harga, 0, ',', '.') }}</p>
            <table>
                <tr>
                    <td class="w-80">Type</td>
                    <td>{{ $otomotif->type}}</td>
                </tr>

                <tr>
                    <td class="w-80">Sub Type</td>
                    <td>{{ $otomotif->subtype}}</td>
                </tr>

                <tr>
                    <td class="w-80">Transmisi</td>
                    <td>{{ $otomotif->transmisi}}</td>
                </tr>

                <tr>
                    <td class="w-80">Kilometer</td>
                    <td>{{ $otomotif->kilometer}}</td>
                </tr>

                <tr>
                    <td class="w-80">Kapasitas Mesin</td>
                    <td>{{ $otomotif->kapasitas_mesin}}</td>
                </tr>

                <tr>
                    <td class="w-80">Merk</td>
                    <td>{{ $otomotif->brand}}</td>
                </tr>

                {{-- <tr>
                    <td class="w-80">STNK</td>
                    <td>{{ $otomotif->STNK}}</td>
                </tr>

                <tr>
                    <td class="w-80">BPKB</td>
                    <td>{{ $otomotif->BPKB}}</td>
                </tr> --}}
            </table>
            <div class="mb-4">
                <span class="bg-{{ $otomotif->status_ads == 'show' ? 'green' : 'red' }}-500 text-white px-3 py-1 rounded">
                    {{ ucfirst($otomotif->status_ads) }}
                </span>
                <span class="bg-{{ $otomotif->status_payment == 'paid' ? 'green' : ($otomotif->status_payment == 'expired' ? 'gray' : 'red') }}-500 text-white px-3 py-1 rounded">
                    {{ ucfirst($otomotif->status_payment) }}
                </span>
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Contact Seller</button>
        </div>
    </div>
</div>
@endsection
