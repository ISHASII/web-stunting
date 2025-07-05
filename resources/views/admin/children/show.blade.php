@extends('layouts.admin')

@section('page-title', 'Detail Anak - ' . $child->name)

@section('main-content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="space-y-4 sm:space-y-6 p-3 sm:p-6">
        <!-- Header Section -->
        <div class="flex flex-col space-y-4 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 gap-4">
            <div>
                <div class="flex items-center gap-3 sm:gap-4">
                    <a href="{{ route('admin.children') }}"
                       class="p-2 sm:p-3 rounded-xl bg-white text-gray-600 hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Detail Anak
                        </h1>
                        <p class="text-gray-600 mt-1 sm:mt-2 text-sm sm:text-base lg:text-lg">
                            Informasi lengkap dan riwayat pengukuran {{ $child->name }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Actions Section -->
            <div class="flex flex-col sm:flex-row flex-wrap gap-2 sm:gap-3">
                <!-- Edit Button -->
                <a href="{{ route('admin.children.edit', $child) }}"
                   class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl shadow-lg text-xs sm:text-sm font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span class="hidden sm:inline">Edit Data</span>
                    <span class="sm:hidden">Edit</span>
                </a>

                <!-- Delete Button -->
                <button onclick="confirmDelete('{{ $child->id }}', '{{ $child->name }}', '{{ $measurements->count() }}')"
                        class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-xl shadow-lg text-xs sm:text-sm font-semibold hover:from-red-700 hover:to-red-800 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <span class="hidden sm:inline">Hapus Data</span>
                    <span class="sm:hidden">Hapus</span>
                </button>

                <!-- Export Actions -->
                <div class="flex gap-2 sm:gap-3">
                    <a href="{{ route('admin.child.export', ['child' => $child->id, 'format' => 'excel']) }}"
                       class="inline-flex items-center justify-center px-3 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl shadow-lg text-xs sm:text-sm font-semibold hover:from-green-700 hover:to-green-800 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="hidden sm:inline">Export Excel</span>
                        <span class="sm:hidden">Excel</span>
                    </a>

                    <a href="{{ route('admin.child.export', ['child' => $child->id, 'format' => 'pdf']) }}"
                       class="inline-flex items-center justify-center px-3 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-yellow-600 to-yellow-700 text-white rounded-xl shadow-lg text-xs sm:text-sm font-semibold hover:from-yellow-700 hover:to-yellow-800 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="hidden sm:inline">Export PDF</span>
                        <span class="sm:hidden">PDF</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 sm:px-6 py-3 sm:py-4 rounded-xl shadow-sm">
                <div class="flex items-center">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm sm:text-base">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 sm:px-6 py-3 sm:py-4 rounded-xl shadow-sm">
                <div class="flex items-center">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm sm:text-base">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Child Information Card -->
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-xl border border-blue-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-4 sm:px-8 py-4 sm:py-6">
                <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white flex items-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Informasi Anak
                </h3>
            </div>

            <div class="p-4 sm:p-6 lg:p-8">
                <div class="grid lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-10">
                    <!-- Photo Section -->
                    <div class="flex flex-col items-center lg:col-span-1">
                        @if($child->photo)
                            <div class="relative">
                                <img src="{{ Storage::url($child->photo) }}" alt="{{ $child->name }}"
                                     class="w-32 h-32 sm:w-40 sm:h-40 lg:w-48 lg:h-48 object-cover rounded-full ring-4 ring-blue-200 shadow-2xl">
                                <div class="absolute -bottom-2 -right-2 sm:-bottom-3 sm:-right-3 bg-green-500 rounded-full p-2 sm:p-3 shadow-lg">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        @else
                            <div class="w-32 h-32 sm:w-40 sm:h-40 lg:w-48 lg:h-48 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center ring-4 ring-blue-200 shadow-2xl">
                                <span class="text-white text-3xl sm:text-4xl lg:text-5xl font-bold">{{ substr($child->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <h2 class="mt-4 sm:mt-6 text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 text-center">{{ $child->name }}</h2>
                        <p class="text-gray-600 font-semibold text-sm sm:text-base lg:text-lg mt-1 sm:mt-2">
                            {{ $child->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                    </div>

                    <!-- Basic Information -->
                    <div class="lg:col-span-2">
                        <div class="grid sm:grid-cols-2 gap-4 sm:gap-6 lg:gap-8">
                            <div class="space-y-4 sm:space-y-6 lg:space-y-8">
                                <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg sm:rounded-xl p-4 sm:p-6 shadow-sm">
                                    <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2 sm:mb-3">NIK</label>
                                    <p class="text-sm sm:text-lg lg:text-xl font-mono text-gray-900 bg-white px-3 sm:px-4 py-2 sm:py-3 rounded-lg border-2 border-gray-200 break-all">
                                        {{ $child->nik }}
                                    </p>
                                </div>

                                <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg sm:rounded-xl p-4 sm:p-6 shadow-sm">
                                    <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2 sm:mb-3">Tanggal Lahir</label>
                                    <p class="text-sm sm:text-lg lg:text-xl text-gray-900 bg-white px-3 sm:px-4 py-2 sm:py-3 rounded-lg border-2 border-gray-200">
                                        {{ $child->birth_date->format('d F Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-4 sm:space-y-6 lg:space-y-8">
                                <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg sm:rounded-xl p-4 sm:p-6 shadow-sm">
                                    <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2 sm:mb-3">Umur Saat Ini</label>
                                    <p class="text-sm sm:text-lg lg:text-xl text-gray-900 bg-white px-3 sm:px-4 py-2 sm:py-3 rounded-lg border-2 border-gray-200">
                                        {{ floor($child->age_in_months) }} bulan
                                    </p>
                                </div>

                                <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg sm:rounded-xl p-4 sm:p-6 shadow-sm">
                                    <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2 sm:mb-3">Total Pengukuran</label>
                                    <p class="text-sm sm:text-lg lg:text-xl text-gray-900 bg-white px-3 sm:px-4 py-2 sm:py-3 rounded-lg border-2 border-gray-200">
                                        {{ $measurements->count() }} kali
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Measurement Card -->
        @if($child->latest_measurement)
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-xl border border-green-100 overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-4 sm:px-8 py-4 sm:py-6">
                <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white flex items-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Pengukuran Terakhir
                </h3>
            </div>

            <div class="p-4 sm:p-6 lg:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4 lg:gap-6">
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg sm:rounded-xl p-3 sm:p-4 lg:p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="text-lg sm:text-2xl lg:text-3xl font-bold text-blue-700 mb-1 sm:mb-2">
                            {{ $child->latest_measurement->measurement_date->format('d/m/Y') }}
                        </div>
                        <div class="text-xs sm:text-sm text-blue-600 font-semibold">Tanggal Pengukuran</div>
                    </div>

                    <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg sm:rounded-xl p-3 sm:p-4 lg:p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="text-lg sm:text-2xl lg:text-3xl font-bold text-purple-700 mb-1 sm:mb-2">
                            {{ floor($child->latest_measurement->height) }} cm
                        </div>
                        <div class="text-xs sm:text-sm text-purple-600 font-semibold">Tinggi Badan</div>
                    </div>

                    <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg sm:rounded-xl p-3 sm:p-4 lg:p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="text-lg sm:text-2xl lg:text-3xl font-bold text-green-700 mb-1 sm:mb-2">
                            {{ $child->latest_measurement->weight ? number_format($child->latest_measurement->weight, 1) : '-' }} kg
                        </div>
                        <div class="text-xs sm:text-sm text-green-600 font-semibold">Berat Badan</div>
                    </div>

                    <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg sm:rounded-xl p-3 sm:p-4 lg:p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="text-lg sm:text-2xl lg:text-3xl font-bold text-orange-700 mb-1 sm:mb-2">
                            {{ number_format($child->latest_measurement->z_score, 2) }}
                        </div>
                        <div class="text-xs sm:text-sm text-orange-600 font-semibold">Z-Score</div>
                    </div>

                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg sm:rounded-xl p-3 sm:p-4 lg:p-6 text-center hover:shadow-lg transition-shadow sm:col-span-2 lg:col-span-1">
                        <div class="flex flex-col items-center">
                            <span class="inline-flex items-center px-3 sm:px-4 py-1 sm:py-2 text-xs sm:text-sm font-bold rounded-full mb-2 sm:mb-3
                                @if($child->latest_measurement->status == 'Sangat Pendek') bg-red-100 text-red-800
                                @elseif($child->latest_measurement->status == 'Pendek') bg-orange-100 text-orange-800
                                @elseif($child->latest_measurement->status == 'Normal') bg-green-100 text-green-800
                                @else bg-blue-100 text-blue-800 @endif">
                                {{ $child->latest_measurement->status }}
                            </span>
                            <div class="text-xs text-gray-600 font-medium">Status Gizi</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 sm:mt-6 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg sm:rounded-xl p-4 sm:p-6 shadow-sm">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                        <span class="text-gray-700 font-semibold text-sm sm:text-base">Petugas yang mengukur:</span>
                        <span class="text-gray-900 font-bold text-sm sm:text-base">
                            {{ $child->latest_measurement->user ? $child->latest_measurement->user->name : 'Publik' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-500 to-gray-600 px-4 sm:px-8 py-4 sm:py-6">
                <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white">Pengukuran Terakhir</h3>
            </div>
            <div class="p-6 sm:p-8 lg:p-12 text-center">
                <svg class="mx-auto h-12 w-12 sm:h-16 sm:w-16 lg:h-20 lg:w-20 text-gray-400 mb-4 sm:mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <p class="text-gray-500 text-lg sm:text-xl font-semibold">Belum ada pengukuran</p>
                <p class="text-gray-400 text-sm sm:text-base lg:text-lg mt-2">Silakan tambahkan pengukuran untuk anak ini</p>
            </div>
        </div>
        @endif

        <!-- Measurements History -->
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-xl border border-indigo-100 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-4 sm:px-8 py-4 sm:py-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white flex items-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Riwayat Pengukuran
                    </h3>
                    <span class="bg-white/20 text-white px-3 sm:px-4 py-1 sm:py-2 rounded-full text-xs sm:text-sm font-bold">
                        {{ $measurements->count() }} pengukuran
                    </span>
                </div>
            </div>

            @if($measurements->count() > 0)
                <!-- Mobile Card View -->
                <div class="block sm:hidden">
                    @foreach($measurements as $index => $measurement)
                    <div class="border-b border-gray-200 p-4 {{ $index === 0 ? 'bg-blue-50/50' : '' }}">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                @if($index === 0)
                                    <div class="bg-blue-100 p-1 rounded-full mr-2">
                                        <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">{{ $measurement->measurement_date->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $measurement->measurement_date->diffForHumans() }}</div>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2 py-1 text-xs font-bold rounded-full
                                @if($measurement->status == 'Sangat Pendek') bg-red-100 text-red-800
                                @elseif($measurement->status == 'Pendek') bg-orange-100 text-orange-800
                                @elseif($measurement->status == 'Normal') bg-green-100 text-green-800
                                @else bg-blue-100 text-blue-800 @endif">
                                {{ $measurement->status }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <span class="text-gray-500">Umur:</span>
                                <span class="font-semibold text-gray-900 ml-1">{{ $measurement->age_months }} bulan</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Tinggi:</span>
                                <span class="font-semibold text-gray-900 ml-1">{{ floor($measurement->height) }} cm</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Berat:</span>
                                <span class="font-semibold text-gray-900 ml-1">{{ $measurement->weight ? number_format($measurement->weight, 1) : '-' }} kg</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Z-Score:</span>
                                <span class="font-semibold text-gray-900 ml-1">{{ number_format($measurement->z_score, 2) }}</span>
                            </div>
                        </div>

                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-6 w-6">
                                    <div class="h-6 w-6 bg-gradient-to-r from-gray-300 to-gray-400 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-bold text-gray-700">
                                            {{ $measurement->user ? substr($measurement->user->name, 0, 1) : 'P' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-2">
                                    <div class="text-xs font-medium text-gray-900">
                                        {{ $measurement->user ? $measurement->user->name : 'Publik' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Desktop Table View -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="hidden sm:inline">Tanggal</span>
                                    </div>
                                </th>
                                <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    <span class="hidden sm:inline">Umur (Bulan)</span>
                                    <span class="sm:hidden">Umur</span>
                                </th>
                                <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    <span class="hidden sm:inline">Tinggi (cm)</span>
                                    <span class="sm:hidden">Tinggi</span>
                                </th>
                                <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    <span class="hidden sm:inline">Berat (kg)</span>
                                    <span class="sm:hidden">Berat</span>
                                </th>
                                <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Z-Score
                                </th>
                                <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Petugas
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($measurements as $index => $measurement)
                            <tr class="hover:bg-blue-50 transition-colors duration-200 {{ $index === 0 ? 'bg-blue-50/50' : '' }}">
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($index === 0)
                                            <div class="bg-blue-100 p-1 sm:p-2 rounded-full mr-2 sm:mr-3">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-xs sm:text-sm font-semibold text-gray-900">{{ $measurement->measurement_date->format('d/m/Y') }}</div>
                                            <div class="text-xs text-gray-500 hidden sm:block">{{ $measurement->measurement_date->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                    <div class="text-xs sm:text-sm font-semibold text-gray-900">{{ $measurement->age_months }}</div>
                                </td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                    <div class="text-xs sm:text-sm font-semibold text-gray-900">{{ floor($measurement->height) }}</div>
                                </td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                    <div class="text-xs sm:text-sm font-semibold text-gray-900">{{ $measurement->weight ? number_format($measurement->weight, 1) : '-' }}</div>
                                </td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                    <div class="text-xs sm:text-sm font-semibold text-gray-900">{{ number_format($measurement->z_score, 2) }}</div>
                                </td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2 sm:px-3 py-1 text-xs font-bold rounded-full
                                        @if($measurement->status == 'Sangat Pendek') bg-red-100 text-red-800
                                        @elseif($measurement->status == 'Pendek') bg-orange-100 text-orange-800
                                        @elseif($measurement->status == 'Normal') bg-green-100 text-green-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        @if($measurement->status == 'Normal')
                                            <svg class="w-2 h-2 sm:w-3 sm:h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        @else
                                            <svg class="w-2 h-2 sm:w-3 sm:h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                        <span class="hidden sm:inline">{{ $measurement->status }}</span>
                                        <span class="sm:hidden">{{ substr($measurement->status, 0, 6) }}{{ strlen($measurement->status) > 6 ? '...' : '' }}</span>
                                    </span>
                                </td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-6 w-6 sm:h-8 sm:w-8 lg:h-10 lg:w-10">
                                            <div class="h-6 w-6 sm:h-8 sm:w-8 lg:h-10 lg:w-10 bg-gradient-to-r from-gray-300 to-gray-400 rounded-full flex items-center justify-center">
                                                <span class="text-xs sm:text-sm font-bold text-gray-700">
                                                    {{ $measurement->user ? substr($measurement->user->name, 0, 1) : 'P' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-2 sm:ml-3 lg:ml-4 hidden sm:block">
                                            <div class="text-xs sm:text-sm font-semibold text-gray-900">
                                                {{ $measurement->user ? $measurement->user->name : 'Publik' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-4 sm:px-6 py-12 sm:py-16 lg:py-20 text-center">
                    <svg class="mx-auto h-12 w-12 sm:h-16 sm:w-16 lg:h-20 lg:w-20 text-gray-400 mb-4 sm:mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <h3 class="mt-4 sm:mt-6 text-lg sm:text-xl font-bold text-gray-900">Belum ada data pengukuran</h3>
                    <p class="mt-2 sm:mt-3 text-gray-500 text-sm sm:text-base lg:text-lg">Mulai dengan menambahkan pengukuran pertama untuk anak ini.</p>
                    <div class="mt-6 sm:mt-8">
                        <a href="{{ route('petugas.measurement.create') }}?child_id={{ $child->id }}"
                           class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl font-semibold text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Pengukuran
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
            <a href="{{ route('admin.children') }}"
               class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-xl hover:from-gray-700 hover:to-gray-800 transition-all duration-300 shadow-lg hover:shadow-xl font-semibold text-sm sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-2xl max-w-sm sm:max-w-md w-full mx-3 sm:mx-4 transform transition-all duration-300 scale-95">
        <div class="p-6 sm:p-8">
            <div class="flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 mx-auto bg-red-100 rounded-full mb-4 sm:mb-6">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </div>
            <h3 class="text-xl sm:text-2xl font-bold text-gray-900 text-center mb-2 sm:mb-3">Konfirmasi Penghapusan</h3>
            <div id="deleteMessage" class="text-gray-600 text-center mb-6 sm:mb-8 text-sm sm:text-base">
                <!-- Message will be populated by JavaScript -->
            </div>

            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                <button id="cancelDeleteBtn" type="button"
                        class="flex-1 px-4 sm:px-6 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-xl text-gray-700 hover:bg-gray-50 transition-all duration-300 font-semibold text-sm sm:text-base">
                    Batal
                </button>
                <button id="confirmDeleteBtn" type="button"
                        class="flex-1 px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg sm:rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl text-sm sm:text-base">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden form for deletion -->
<form id="deleteForm" method="POST" action="{{ route('admin.children.destroy', $child) }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmDelete(childId, childName, measurementCount) {
    const modal = document.getElementById('deleteModal');
    const messageDiv = document.getElementById('deleteMessage');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    const cancelBtn = document.getElementById('cancelDeleteBtn');
    const deleteForm = document.getElementById('deleteForm');

    // Set the message based on measurement count
    if (measurementCount > 0) {
        messageDiv.innerHTML = `
            <p class="mb-3 sm:mb-4 text-sm sm:text-lg">Apakah Anda yakin ingin menghapus data anak <strong class="text-red-600">${childName}</strong>?</p>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg sm:rounded-xl p-3 sm:p-4 text-xs sm:text-sm">
                <div class="flex items-center mb-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.262 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    <span class="text-yellow-800 font-bold">Perhatian!</span>
                </div>
                <p class="text-yellow-700 font-medium">Anak ini memiliki <strong>${measurementCount}</strong> data pengukuran yang akan ikut terhapus.</p>
            </div>
        `;
    } else {
        messageDiv.innerHTML = `
            <p class="text-sm sm:text-lg">Apakah Anda yakin ingin menghapus data anak <strong class="text-red-600">${childName}</strong>?</p>
            <p class="text-gray-500 mt-2 sm:mt-3 text-xs sm:text-sm">Tindakan ini tidak dapat dibatalkan.</p>
        `;
    }

    // Show modal with animation
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.querySelector('.bg-white').classList.remove('scale-95');
        modal.querySelector('.bg-white').classList.add('scale-100');
    }, 10);

    // Handle confirm button
    confirmBtn.onclick = function() {
        hideDeleteModal();
        // Submit form after hiding modal
        setTimeout(() => {
            deleteForm.submit();
        }, 300);
    };

    // Handle cancel button
    cancelBtn.onclick = function() {
        hideDeleteModal();
    };

    // Close modal when clicking outside
    modal.onclick = function(e) {
        if (e.target === modal) {
            hideDeleteModal();
        }
    };
}

function hideDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.querySelector('.bg-white').classList.remove('scale-100');
    modal.querySelector('.bg-white').classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('deleteModal');
        if (!modal.classList.contains('hidden')) {
            hideDeleteModal();
        }
    }
});
</script>
@endsection
