<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Deteksi Stunting - Posyandu')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

   <!-- Navbar -->
    <header class="bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4 py-4 md:py-6">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo-puskesmas.png') }}" alt="Logo" class="h-8 w-8">
                <span class="text-lg font-bold">NutriSetra</span>
            </a>

            <nav class="hidden md:flex gap-6 items-center">
                <a href="{{ route('home') }}" class="hover:text-blue-200">Beranda</a>
                <a href="#about" class="hover:text-blue-200">Tentang</a>
                <a href="#gallery" class="hover:text-blue-200">Galeri</a>
                @auth
                    <span>{{ auth()->user()->name }}</span>
                    <a href="{{ auth()->user()->role === 'superadmin' ? route('admin.dashboard') : route('petugas.dashboard') }}"
                       class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block py-2 px-4 mt-2 bg-white text-blue-500 rounded-lg font-semibold text-center hover:bg-green-50">Login</a>
                @endauth
            </nav>

            <!-- Mobile menu button -->
            <button id="mobile-menu-button" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
<div id="mobile-menu" class="hidden md:hidden bg-blue-700 px-4 pb-4 space-y-2">
    <a href="{{ route('home') }}" class="block py-2 text-white">Beranda</a>
    <a href="#about" class="block py-2 text-white">Tentang</a>
    <a href="#gallery" class="block py-2 text-white">Galeri</a>

    @auth
        <div class="text-white font-semibold">{{ auth()->user()->name }}</div>
        <a href="{{ auth()->user()->role === 'superadmin' ? route('admin.dashboard') : route('petugas.dashboard') }}"
           class="block w-full text-center bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">
            Dashboard
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="block w-full text-center bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mt-2">
                Logout
            </button>
        </form>
    @else
        <a href="{{ route('login') }}"
           class="block w-full text-center bg-white text-blue-500 px-4 py-2 rounded-lg font-semibold hover:bg-green-50 mt-2">
            Login
        </a>
    @endauth
</div>
    </header>

    <!-- Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 grid md:grid-cols-4 gap-8">
            <div class="md:col-span-2">
                <h3 class="font-semibold text-lg mb-2">Posyandu Wargasetra</h3>
                <p class="text-gray-300">Melayani masyarakat dengan sepenuh hati, khususnya dalam deteksi dini stunting pada anak.</p>
            </div>
            <div>
                <h4 class="font-semibold text-lg mb-2">Navigasi</h4>
                <ul class="text-gray-300 space-y-1">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
                    <li><a href="#about" class="hover:text-white">Tentang</a></li>
                    <li><a href="#gallery" class="hover:text-white">Galeri</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-lg mb-2">Kontak</h4>
                <ul class="text-gray-300 space-y-1">
                    <li>📍 Jl. Raya Loji Karawang, Kampung Munjul RT 02/ RW 01, Desa Cintalaksana, Tegalwaru, Karawang 41362</li>
                    <li>📞 (022) 1234567</li>
                    <li>✉️ info@puskesmassukamaju.go.id</li>
                    <li>🕒 Senin - Jumat: 08.00 - 15.00</li>
                </ul>
            </div>
        </div>
        <div class="text-center text-gray-400 py-4 border-t border-gray-700">
            &copy; {{ date('Y') }} Posyandu Wargasetra. All rights reserved.
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
