<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halo, ') . Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900">Informasi Pengguna</h3>
                <p class="text-sm text-gray-600">Nama: {{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-600">Google ID: {{ Auth::user()->google_id }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
