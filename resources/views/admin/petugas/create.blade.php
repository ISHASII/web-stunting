@extends('layouts.admin')

@section('page-title', 'Tambah Petugas Baru')

@section('main-content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-blue-100 mb-6">
            <div class="px-8 py-6 border-b border-blue-100/50">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Tambah Petugas Baru
                    </h1>
                </div>
                <p class="text-blue-600/70 mt-2">Lengkapi form di bawah untuk menambahkan petugas baru ke sistem</p>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl border border-blue-100/50 overflow-hidden">
            <div class="p-8">
                <form action="{{ route('admin.petugas.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Grid Layout for wider form -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Nama Lengkap -->
                        <div class="group">
                            <label for="name" class="block text-sm font-semibold text-blue-900 mb-3 flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Nama Lengkap</span>
                            </label>
                            <div class="relative">
                                <input type="text" id="name" name="name" required
                                       class="w-full px-4 py-4 bg-blue-50/50 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-blue-900 placeholder-blue-400"
                                       placeholder="Masukkan nama lengkap petugas"
                                       value="{{ old('name') }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full group-focus-within:bg-blue-600 transition-colors duration-300"></div>
                                </div>
                            </div>
                            @error('name')
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="group">
                            <label for="email" class="block text-sm font-semibold text-blue-900 mb-3 flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>Email</span>
                            </label>
                            <div class="relative">
                                <input type="email" id="email" name="email" required
                                       class="w-full px-4 py-4 bg-blue-50/50 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-blue-900 placeholder-blue-400"
                                       placeholder="contoh@email.com"
                                       value="{{ old('email') }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full group-focus-within:bg-blue-600 transition-colors duration-300"></div>
                                </div>
                            </div>
                            @error('email')
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="group">
                            <label for="password" class="block text-sm font-semibold text-blue-900 mb-3 flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <span>Password</span>
                            </label>
                            <div class="relative">
                                <input type="password" id="password" name="password" required
                                       class="w-full px-4 py-4 bg-blue-50/50 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-blue-900 placeholder-blue-400"
                                       placeholder="Masukkan password yang kuat">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full group-focus-within:bg-blue-600 transition-colors duration-300"></div>
                                </div>
                            </div>
                            @error('password')
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="group">
                            <label for="password_confirmation" class="block text-sm font-semibold text-blue-900 mb-3 flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Konfirmasi Password</span>
                            </label>
                            <div class="relative">
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                       class="w-full px-4 py-4 bg-blue-50/50 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-blue-900 placeholder-blue-400"
                                       placeholder="Ulangi password yang sama">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full group-focus-within:bg-blue-600 transition-colors duration-300"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8">
                        <button type="submit"
                                class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Simpan Petugas</span>
                        </button>
                        <a href="{{ route('admin.petugas') }}"
                           class="flex-1 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 px-8 py-4 rounded-xl font-semibold shadow-md hover:shadow-lg hover:from-gray-200 hover:to-gray-300 transform hover:scale-105 transition-all duration-300 flex items-center justify-center space-x-2 border border-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Batal</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="mt-6 text-center">
            <p class="text-blue-600/60 text-sm">
                Pastikan semua data yang dimasukkan sudah benar sebelum menyimpan
            </p>
        </div>
    </div>
</div>

<style>
    /* Custom focus effects */
    .group:focus-within .w-2 {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    /* Smooth input animations */
    input:focus {
        transform: translateY(-1px);
    }

    /* Button hover effects */
    button:hover, a:hover {
        box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.1), 0 4px 6px -2px rgba(59, 130, 246, 0.05);
    }
</style>
@endsection
