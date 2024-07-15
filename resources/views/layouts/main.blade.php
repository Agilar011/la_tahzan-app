<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- FontAwesome --}}
        <script src="https://kit.fontawesome.com/26216fdb08.js" crossorigin="anonymous"></script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        @vite('resources/css/app.css')
<nav class="bg-slate-800 px-4 py-2">
    <div class="flex justify-between items-center">
        <!-- Logo Section -->
        <div>
            <img src="/img/la tahzan.png" alt="Logo" class="h-12">
        </div>

        <!-- Hamburger Menu (Mobile) -->
        <div class="md:hidden">
            <button id="menu-toggle" class="text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <!-- Navigation Links (Desktop) -->
        <div class="hidden md:block px-2 py-2">
            <ul class="flex space-x-10">
                <li><a href="/about" class="text-white">Umrah</a></li>
                <li><a href="/services" class="text-white">Property</a></li>
                <li><a href="/contact" class="text-white">Otomotif</a></li>
            </ul>
        </div>

        <!-- Authentication Links (Desktop) -->
        @if (Auth::check())
            <div class="hidden md:block">
                <ul class="flex space-x-4">
                    <li><a href="/dashboard" class="text-white">Dashboard</a></li>
                    <li><a href="/logout" class="text-white">Logout</a></li>
                </ul>
            </div>

        @else
        <div class="hidden md:block">
            <ul class="flex space-x-4">
                <li><a href="/login" class="text-white">Login</a></li>
                <li><a href="/register" class="text-white">Register</a></li>
            </ul>
        </div>

        @endif

    </div>

    <!-- Navigation Links (Mobile) -->
    <div id="mobile-menu" class="hidden md:hidden">
        <ul class="flex flex-col space-y-4 mt-4">
            <li><a href="/" class="text-white">Home</a></li>
            <li><a href="/about" class="text-white">Umrah</a></li>
            <li><a href="/services" class="text-white">Property</a></li>
            <li><a href="/contact" class="text-white">Otomotif</a></li>
            <li><a href="/login" class="text-white">Login</a></li>
            <li><a href="/register" class="text-white">Register</a></li>
        </ul>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuToggle = document.getElementById('menu-toggle');
        var mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', function() {
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
            }
        });
    });
</script>


            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            <!-- Footer -->
            {{-- <footer class="bg-slate-800 text-white text-center py-4">
                <p>&copy; 2021 All Rights Reserved</p>
            </footer> --}}

            <footer class="bg-slate-800 px-4 py-2 mt-10">
                <div class="flex justify-between items-center text-white">
                    <!-- Logo Section -->
                    <div>
                        <img src="/img/la tahzan.png" alt="Logo" class="h-12">
                    </div>
                    <ul>
                        <p class="font-bold text-xl">Produk Kami</p>
                        <li>Umrah</li>
                        <li>otomotif</li>
                        <li>Property</li>
                    </ul>

                    <ul>
                        <p class="font-bold text-xl">Tentang Kami</p>
                        <li>About</li>
                        <li>Kebijakan</li>
                        <li>Layanan Periklanan</li>
                    </ul>

                    <ul>
                        <p class="font-bold text-xl">Hubungi Kami</p>
                        <li>Alamat</li>
                        <li>Email</li>
                        <li>Telepon</li>

                    <!-- Hamburger Menu (Mobile) -->
                    {{-- <div class="md:hidden">
                        <button id="menu-toggle" class="text-white focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                    </div>

                    <!-- footerigation Links (Desktop) -->
                    <div class="hidden md:block px-2 py-2">
                        <ul class="flex space-x-10">
                            <li><a href="/about" class="text-white">Umrah</a></li>
                            <li><a href="/services" class="text-white">Property</a></li>
                            <li><a href="/contact" class="text-white">Otomotif</a></li>
                        </ul>
                    </div>

                    <!-- Authentication Links (Desktop) -->
                    <div class="hidden md:block">
                        <ul class="flex space-x-4">
                            <li><a href="/login" class="text-white">Login</a></li>
                            <li><a href="/register" class="text-white">Register</a></li>
                        </ul>
                    </div> --}}
                </div>

                <!-- Navigation Links (Mobile) -->
                {{-- <div id="mobile-menu" class="hidden md:hidden">
                    <ul class="flex flex-col space-y-4 mt-4">
                        <li><a href="/" class="text-white">Home</a></li>
                        <li><a href="/about" class="text-white">Umrah</a></li>
                        <li><a href="/services" class="text-white">Property</a></li>
                        <li><a href="/contact" class="text-white">Otomotif</a></li>
                        <li><a href="/login" class="text-white">Login</a></li>
                        <li><a href="/register" class="text-white">Register</a></li>
                    </ul>
                </div> --}}
            </footer>

        @stack('modals')

        @livewireScripts
    </body>
</html>