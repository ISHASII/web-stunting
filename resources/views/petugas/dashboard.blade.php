@extends('layouts.admin')

@section('page-title', 'Dashboard Petugas')

@section('main-content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 shadow-2xl border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
                        <p class="text-blue-100 text-lg">Dashboard Petugas - Sistem Deteksi Stunting</p>
                        <div class="mt-4 flex items-center space-x-2 text-blue-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v8a1 1 0 01-1 1H5a1 1 0 01-1-1V8a1 1 0 011-1h3z"></path>
                            </svg>
                            <span class="text-sm">{{ now()->format('l, d F Y') }}</span>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <!-- Total Pengukuran Card -->
            <div class="group bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-3xl border border-blue-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                <div class="p-8">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide">Total Pengukuran Saya</p>
                                    <p class="text-4xl font-bold text-blue-900 mt-1">{{ $myMeasurements }}</p>
                                    <p class="text-blue-500 text-sm mt-1">Pengukuran dilakukan</p>
                                </div>
                            </div>
                        </div>
                        <div class="hidden sm:block">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center">
                                <div class="text-4xl">📊</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-600"></div>
            </div>

            <!-- Pengukuran Hari Ini Card -->
            <div class="group bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-3xl border border-blue-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                <div class="p-8">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v8a1 1 0 01-1 1H5a1 1 0 01-1-1V8a1 1 0 011-1h3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Pengukuran Hari Ini</p>
                                    <p class="text-4xl font-bold text-indigo-900 mt-1">{{ $todayMeasurements }}</p>
                                    <p class="text-indigo-500 text-sm mt-1">Hari ini</p>
                                </div>
                            </div>
                        </div>
                        <div class="hidden sm:block">
                            <div class="w-24 h-24 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-2xl flex items-center justify-center">
                                <div class="text-4xl">📅</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-2 bg-gradient-to-r from-indigo-500 to-indigo-600"></div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl border border-blue-100 mb-10 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white">Menu Utama</h3>
                        <p class="text-blue-100 text-sm">Akses cepat untuk fungsi utama</p>
                    </div>
                </div>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Pengukuran Baru -->
                    <a href="{{ route('petugas.measurement.create') }}"
                       class="group bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border-2 border-blue-200 hover:border-blue-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-bold text-blue-900 mb-1">Pengukuran Baru</h4>
                                <p class="text-blue-600 text-sm">Lakukan pengukuran stunting anak baru</p>
                                <div class="mt-3 flex items-center text-blue-500">
                                    <span class="text-xs font-medium">Mulai sekarang</span>
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Riwayat Pengukuran -->
                    <a href="{{ route('petugas.measurement.history') }}"
                       class="group bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl p-6 border-2 border-indigo-200 hover:border-indigo-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-bold text-indigo-900 mb-1">Riwayat Pengukuran</h4>
                                <p class="text-indigo-600 text-sm">Lihat pengukuran yang telah dilakukan</p>
                                <div class="mt-3 flex items-center text-indigo-500">
                                    <span class="text-xs font-medium">Lihat semua</span>
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Information Panel -->
<div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl border border-blue-100 overflow-hidden">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-4 sm:px-8 py-4 sm:py-6">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 sm:w-10 sm:h-10 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <h3 class="text-lg sm:text-xl font-semibold text-white truncate">Informasi Penting</h3>
                <p class="text-blue-100 text-xs sm:text-sm">Panduan dan tips penggunaan sistem</p>
            </div>
        </div>
    </div>

    <div class="p-4 sm:p-8">
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border-l-4 border-blue-500 rounded-2xl p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-start space-y-4 sm:space-y-0 sm:space-x-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0 mx-auto sm:mx-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>

                <div class="flex-1 text-center sm:text-left">
                    <h4 class="text-base sm:text-lg font-bold text-blue-900 mb-2 sm:mb-3">Panduan Penggunaan Sistem</h4>
                    <p class="text-blue-700 text-sm sm:text-base mb-4 leading-relaxed">
                        Anda dapat melakukan pengukuran stunting anak dan melihat riwayat pengukuran yang telah dilakukan sebelumnya.
                    </p>

                    <!-- Mobile-First Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 mt-4 sm:mt-6">
                        <!-- Card 1 -->
                        <div class="bg-white rounded-xl p-3 sm:p-4 border border-blue-200 shadow-sm hover:shadow-md transition-shadow duration-200 active:scale-95 sm:active:scale-100 sm:hover:scale-105 transform transition-transform">
                            <div class="flex items-start space-x-3 sm:space-x-2 sm:flex-col sm:space-y-2 sm:space-x-0">
                                <div class="w-8 h-8 sm:w-6 sm:h-6 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-xs font-bold">1</span>
                                </div>
                                <div class="flex-1 sm:flex-none">
                                    <span class="font-semibold text-blue-900 text-sm sm:text-base block">Akurasi Data</span>
                                    <p class="text-blue-600 text-xs sm:text-sm mt-1 leading-relaxed">
                                        Pastikan data yang dimasukkan akurat dan sesuai dengan hasil pengukuran
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="bg-white rounded-xl p-3 sm:p-4 border border-blue-200 shadow-sm hover:shadow-md transition-shadow duration-200 active:scale-95 sm:active:scale-100 sm:hover:scale-105 transform transition-transform">
                            <div class="flex items-start space-x-3 sm:space-x-2 sm:flex-col sm:space-y-2 sm:space-x-0">
                                <div class="w-8 h-8 sm:w-6 sm:h-6 bg-indigo-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-xs font-bold">2</span>
                                </div>
                                <div class="flex-1 sm:flex-none">
                                    <span class="font-semibold text-indigo-900 text-sm sm:text-base block">Standar WHO</span>
                                    <p class="text-indigo-600 text-xs sm:text-sm mt-1 leading-relaxed">
                                        Sistem menggunakan standar WHO untuk perhitungan Z-Score yang akurat
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="bg-white rounded-xl p-3 sm:p-4 border border-blue-200 shadow-sm hover:shadow-md transition-shadow duration-200 active:scale-95 sm:active:scale-100 sm:hover:scale-105 transform transition-transform sm:col-span-2 lg:col-span-1">
                            <div class="flex items-start space-x-3 sm:space-x-2 sm:flex-col sm:space-y-2 sm:space-x-0">
                                <div class="w-8 h-8 sm:w-6 sm:h-6 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-xs font-bold">3</span>
                                </div>
                                <div class="flex-1 sm:flex-none">
                                    <span class="font-semibold text-blue-900 text-sm sm:text-base block">Konsultasi</span>
                                    <p class="text-blue-600 text-xs sm:text-sm mt-1 leading-relaxed">
                                        Konsultasikan hasil dengan tenaga medis jika diperlukan
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>
@endsection
