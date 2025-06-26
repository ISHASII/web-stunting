@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-xl font-bold">Sistem Deteksi Stunting</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="hover:text-blue-200">Beranda</a>
                    <a href="{{ route('stunting.form') }}" class="hover:text-blue-200">Cek Stunting</a>
                    @auth
                        @if(auth()->user()->isSuperadmin())
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-200">Dashboard Admin</a>
                        @else
                            <a href="{{ route('petugas.dashboard') }}" class="hover:text-blue-200">Dashboard Petugas</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-blue-200">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-blue-200">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1">
        @yield('main-content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Sistem Deteksi Stunting - Puskesmas</p>
        </div>
    </footer>
</div>
@endsection
