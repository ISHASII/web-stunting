@extends('layouts.admin')

@section('page-title', 'Riwayat Pengukuran')

@section('main-content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header Section -->
        <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl border border-blue-100 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-white">Riwayat Pengukuran</h1>
                        <p class="text-blue-100 mt-2">Total {{ $measurements->total() }} pengukuran telah dilakukan</p>
                    </div>
                    <div class="hidden sm:block">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl border border-blue-100 overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-blue-100 bg-blue-50/50">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-blue-900">Filter Data</h3>
                </div>
            </div>

            <div class="p-6">
                <form method="GET" action="{{ route('petugas.measurement.history') }}" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Search -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                                Cari NIK/Nama
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                       placeholder="NIK atau nama anak..."
                                       class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                            </label>
                            <select name="status" id="status"
                                    class="block w-full py-2.5 px-3 border border-gray-300 bg-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Status</option>
                                <option value="Normal" {{ request('status') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="Pendek" {{ request('status') == 'Pendek' ? 'selected' : '' }}>Pendek</option>
                                <option value="Sangat Pendek" {{ request('status') == 'Sangat Pendek' ? 'selected' : '' }}>Sangat Pendek</option>
                                <option value="Tinggi" {{ request('status') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>
                        </div>

                        <!-- Date From -->
                        <div>
                            <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">
                                Dari Tanggal
                            </label>
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                   class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Date To -->
                        <div>
                            <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">
                                Sampai Tanggal
                            </label>
                            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                   class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Filter Actions -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Filter
                        </button>
                        <a href="{{ route('petugas.measurement.history') }}"
                           class="inline-flex items-center justify-center px-6 py-2.5 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset
                        </a>

                        <!-- Export Buttons -->
                        <div class="flex flex-col sm:flex-row gap-2 ml-auto">
                            <a href="{{ route('petugas.measurement.export.excel', request()->query()) }}"
                               class="inline-flex items-center justify-center px-6 py-2.5 border border-green-300 text-sm font-medium rounded-lg text-green-700 bg-green-50 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Export Excel
                            </a>
                            <a href="{{ route('petugas.measurement.export.pdf', request()->query()) }}"
                               class="inline-flex items-center justify-center px-6 py-2.5 border border-red-300 text-sm font-medium rounded-lg text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Export PDF
                            </a>
                        </div>
                    </div>

                    <!-- Active Filters -->
                    @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-medium text-blue-900">Filter Aktif:</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @if(request('search'))
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Pencarian: "{{ request('search') }}"
                                    </span>
                                @endif
                                @if(request('status'))
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Status: {{ request('status') }}
                                    </span>
                                @endif
                                @if(request('date_from'))
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Dari: {{ \Carbon\Carbon::parse(request('date_from'))->format('d/m/Y') }}
                                    </span>
                                @endif
                                @if(request('date_to'))
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Sampai: {{ \Carbon\Carbon::parse(request('date_to'))->format('d/m/Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl border border-blue-100 overflow-hidden">
            @if($measurements->count() > 0)
                <!-- Table Header -->
                <div class="px-6 py-4 border-b border-blue-100 bg-blue-50/50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-semibold text-blue-900">
                            Data Pengukuran
                            @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                                <span class="text-sm font-normal text-gray-500">(Hasil Filter)</span>
                            @endif
                        </h3>
                        <p class="text-sm text-blue-700 mt-1 sm:mt-0">
                            Menampilkan {{ $measurements->count() }} dari {{ $measurements->total() }} data
                        </p>
                    </div>
                </div>

                <!-- Mobile Cards (visible on small screens) -->
                <div class="block sm:hidden">
                    @foreach($measurements as $measurement)
                        <div class="border-b border-gray-200 p-4 hover:bg-blue-50/50 transition-colors">
                            <div class="space-y-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $measurement->child->name }}</p>
                                        <p class="text-sm text-gray-500">NIK: {{ $measurement->child->nik }}</p>
                                    </div>
                                    <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full
                                        @if($measurement->status == 'Sangat Pendek') bg-red-100 text-red-800
                                        @elseif($measurement->status == 'Pendek') bg-orange-100 text-orange-800
                                        @elseif($measurement->status == 'Normal') bg-green-100 text-green-800
                                        @elseif($measurement->status == 'Tinggi') bg-purple-100 text-purple-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ $measurement->status }}
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-500">Tanggal:</span>
                                        <p class="font-medium">{{ $measurement->measurement_date->format('d/m/Y') }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Umur:</span>
                                        <p class="font-medium">{{ $measurement->age_months }} bulan</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Tinggi:</span>
                                        <p class="font-medium">{{ floor($measurement->height) }} cm</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Berat:</span>
                                        <p class="font-medium">{{ $measurement->weight ? number_format($measurement->weight, 1) . ' kg' : '-' }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Z-Score:</span>
                                        <p class="font-medium">{{ number_format($measurement->z_score, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Desktop Table (hidden on small screens) -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase tracking-wider">
                                    NIK
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase tracking-wider">
                                    Nama Anak
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase tracking-wider">
                                    Umur (Bulan)
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase tracking-wider">
                                    Tinggi (cm)
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase tracking-wider">
                                    Berat (kg)
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase tracking-wider">
                                    Z-Score
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-blue-900 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($measurements as $measurement)
                            <tr class="hover:bg-blue-50/50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                    {{ $measurement->measurement_date->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-mono text-gray-900 bg-gray-100 px-2 py-1 rounded">
                                        {{ $measurement->child->nik }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $measurement->child->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $measurement->age_months }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                    {{ floor($measurement->height) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                    {{ $measurement->weight ? number_format($measurement->weight, 1) : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-mono">
                                    {{ number_format($measurement->z_score, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full
                                        @if($measurement->status == 'Sangat Pendek') bg-red-100 text-red-800
                                        @elseif($measurement->status == 'Pendek') bg-orange-100 text-orange-800
                                        @elseif($measurement->status == 'Normal') bg-green-100 text-green-800
                                        @elseif($measurement->status == 'Tinggi') bg-purple-100 text-purple-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ $measurement->status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $measurements->appends(request()->query())->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-blue-100 rounded-full mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                            Tidak ada data yang sesuai dengan filter
                        @else
                            Belum ada pengukuran yang dilakukan
                        @endif
                    </h3>
                    <p class="text-gray-500 mb-6">
                        @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                            Coba ubah atau hapus filter untuk melihat lebih banyak data.
                        @else
                            Mulai dengan melakukan pengukuran pertama untuk tracking pertumbuhan anak.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                        <a href="{{ route('petugas.measurement.history') }}"
                           class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors mr-4">
                            Hapus Semua Filter
                        </a>
                    @endif
                    <a href="{{ route('petugas.measurement.create') }}"
                       class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Lakukan Pengukuran
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
