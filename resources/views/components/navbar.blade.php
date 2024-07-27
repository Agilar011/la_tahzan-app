@vite('resources/css/app.css')
<nav class="bg-blue-400 px-4 py-2">
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
        <div class="hidden md:block">
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
        </div>
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
