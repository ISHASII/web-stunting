{{-- filepath: c:\Users\ilham\Documents\deteksi-stunting\resources\views\admin\children\index.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Data Anak')

@section('main-content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-6">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                            Data Anak
                        </h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Kelola dan pantau data anak untuk deteksi stunting
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <div class="bg-white overflow-hidden rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-gray-600">Total Anak</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $children->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-gray-600">Normal</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $normalCount ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.262 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-gray-600">Pendek</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $pendekCount ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-gray-600">Sangat Pendek</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $sangatPendekCount ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-gray-600">Tinggi</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $tinggiCount ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
            <!-- Filter Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Filter & Pencarian</h3>
                        <p class="text-sm text-gray-500">Filter data berdasarkan kriteria tertentu</p>
                    </div>
                </div>
            </div>

            <!-- Filter Form -->
            <div class="p-6">
                <form method="GET" action="{{ route('admin.children') }}" class="space-y-6" x-data="filterForm()">
                    <!-- Filter Options Row 1 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Search Input -->
                        <div class="lg:col-span-1">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                                Pencarian
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text"
                                       name="search"
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="Nama atau NIK anak..."
                                       class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors">
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label for="status_filter" class="block text-sm font-medium text-gray-700 mb-2">
                                Status Stunting
                            </label>
                            <select name="status_filter"
                                    id="status_filter"
                                    class="block w-full py-2.5 px-3 border border-gray-300 bg-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors">
                                <option value="">Semua Status</option>
                                <option value="Normal" {{ request('status_filter') == 'Normal' ? 'selected' : '' }}>
                                    Normal
                                </option>
                                <option value="Pendek" {{ request('status_filter') == 'Pendek' ? 'selected' : '' }}>
                                    Pendek (Stunting)
                                </option>
                                <option value="Sangat Pendek" {{ request('status_filter') == 'Sangat Pendek' ? 'selected' : '' }}>
                                    Sangat Pendek (Severe Stunting)
                                </option>
                                <option value="Tinggi" {{ request('status_filter') == 'Tinggi' ? 'selected' : '' }}>
                                    Tinggi
                                </option>
                                <option value="Belum Diukur" {{ request('status_filter') == 'Belum Diukur' ? 'selected' : '' }}>
                                    Belum Diukur
                                </option>
                            </select>
                        </div>

                        <!-- Gender Filter -->
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Kelamin
                            </label>
                            <select name="gender"
                                    id="gender"
                                    class="block w-full py-2.5 px-3 border border-gray-300 bg-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors">
                                <option value="">Semua</option>
                                <option value="L" {{ request('gender') == 'L' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="P" {{ request('gender') == 'P' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Date Filter Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Filter Type -->
                        <div>
                            <label for="filter_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Filter Berdasarkan
                            </label>
                            <select name="filter_type"
                                    id="filter_type"
                                    class="block w-full py-2.5 px-3 border border-gray-300 bg-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors">
                                <option value="created_at" {{ request('filter_type', 'created_at') == 'created_at' ? 'selected' : '' }}>
                                    Tanggal Registrasi
                                </option>
                                <option value="birth_date" {{ request('filter_type') == 'birth_date' ? 'selected' : '' }}>
                                    Tanggal Lahir
                                </option>
                            </select>
                        </div>

                        <!-- Date From -->
                        <div>
                            <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">
                                Dari Tanggal
                            </label>
                            <input type="date"
                                   name="date_from"
                                   id="date_from"
                                   value="{{ request('date_from') }}"
                                   class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors">
                        </div>

                        <!-- Date To -->
                        <div>
                            <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">
                                Sampai Tanggal
                            </label>
                            <input type="date"
                                   name="date_to"
                                   id="date_to"
                                   value="{{ request('date_to') }}"
                                   class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors">
                        </div>

                        <!-- Filter Actions -->
                        <div class="flex flex-col justify-end">
                            <div class="flex space-x-3">
                                <button type="submit"
                                        class="flex-1 inline-flex justify-center items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Filter
                                </button>
                                <a href="{{ route('admin.children') }}"
                                   class="inline-flex justify-center items-center px-4 py-2.5 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Reset
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Active Filters -->
                    @if(request()->hasAny(['search', 'status_filter', 'gender', 'filter_type', 'date_from', 'date_to']))
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-blue-900">Filter Aktif:</span>
                                </div>
                                <div class="flex flex-wrap gap-2 mt-2 sm:mt-0">
                                    @if(request('search'))
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Pencarian: "{{ request('search') }}"
                                        </span>
                                    @endif
                                    @if(request('status_filter'))
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Status: {{ request('status_filter') }}
                                        </span>
                                    @endif
                                    @if(request('gender'))
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ request('gender') == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    @endif
                                    @if(request('filter_type') && request('filter_type') != 'created_at')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Filter: Tanggal Lahir
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
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Data Table Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            Daftar Anak
                            @if(request()->hasAny(['search', 'status_filter', 'gender', 'filter_type', 'date_from', 'date_to']))
                                <span class="text-sm font-normal text-gray-500">(Hasil Filter)</span>
                            @endif
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Menampilkan {{ $children->total() }} data anak
                            @if(request()->hasAny(['search', 'status_filter', 'gender', 'filter_type', 'date_from', 'date_to']))
                                dari hasil filter
                            @endif
                        </p>
                    </div>

                    <!-- Export Buttons -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.export', array_merge(['format' => 'excel'], request()->all())) }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            Excel
                        </a>
                        <a href="{{ route('admin.export', array_merge(['format' => 'pdf'], request()->all())) }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            PDF
                        </a>
                    </div>
                </div>
            </div>

            @if($children->count() > 0)
                <!-- Table -->
                <div class="overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Anak
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        NIK
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Info Dasar
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status Terakhir
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Riwayat
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($children as $child)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($child->photo)
                                                    <img src="{{ Storage::url($child->photo) }}"
                                                         alt="{{ $child->name }}"
                                                         class="h-10 w-10 rounded-full object-cover">
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                                                        <span class="text-sm font-medium text-white">
                                                            {{ substr($child->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $child->name }}</div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $child->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-mono text-gray-900 bg-gray-100 px-2 py-1 rounded">
                                            {{ $child->nik }}
                                        </div>
                                    </td>
                                   <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <div class="font-medium">{{ floor($child->age_in_months) }} bulan</div>
                                            <div class="text-gray-500">
                                                @if($child->latest_measurement && $child->latest_measurement->height)
                                                    Tinggi: {{ floor($child->latest_measurement->height) }} cm
                                                    <br>Berat: {{ floor($child->latest_measurement->weight) }} kg
                                                    @if($child->latest_measurement->head_circumference)
                                                        <br>LK: {{ floor($child->latest_measurement->head_circumference) }} cm
                                                    @endif
                                                    @if($child->latest_measurement->arm_circumference)
                                                        <br>LLA: {{ floor($child->latest_measurement->arm_circumference) }} cm
                                                    @endif
                                                @else
                                                    {{ \Carbon\Carbon::parse($child->birth_date)->format('d M Y') }}
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <div class="font-medium">Lahir: {{ \Carbon\Carbon::parse($child->birth_date)->format('d/m/Y') }}</div>
                                            <div class="text-gray-500">Daftar: {{ $child->created_at->format('d/m/Y') }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($child->latest_measurement)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($child->latest_measurement->status == 'Sangat Pendek') bg-red-100 text-red-800
                                                @elseif($child->latest_measurement->status == 'Pendek') bg-orange-100 text-orange-800
                                                @elseif($child->latest_measurement->status == 'Normal') bg-green-100 text-green-800
                                                @elseif($child->latest_measurement->status == 'Tinggi') bg-purple-100 text-purple-800
                                                @else bg-blue-100 text-blue-800 @endif">
                                                {{ $child->latest_measurement->status }}
                                            </span>
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ \Carbon\Carbon::parse($child->latest_measurement->measurement_date)->diffForHumans() }}
                                            </div>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Belum diukur
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                            {{ $child->measurements->count() }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.children.show', $child) }}"
                                           class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $children->appends(request()->query())->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-sm font-medium text-gray-900">
                        @if(request()->hasAny(['search', 'status_filter', 'gender', 'filter_type', 'date_from', 'date_to']))
                            Tidak ada data anak yang sesuai dengan filter
                        @else
                            Tidak ada data anak
                        @endif
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        @if(request()->hasAny(['search', 'status_filter', 'gender', 'filter_type', 'date_from', 'date_to']))
                            Coba ubah atau hapus filter untuk melihat lebih banyak data.
                        @else
                            Mulai dengan menambahkan data anak baru untuk monitoring stunting.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'status_filter', 'gender', 'filter_type', 'date_from', 'date_to']))
                        <div class="mt-6">
                            <a href="{{ route('admin.children') }}"
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Hapus Semua Filter
                            </a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function filterForm() {
    return {
        init() {
            // Set date constraints
            const dateFromInput = document.getElementById('date_from');
            const dateToInput = document.getElementById('date_to');

            if (dateFromInput && dateToInput) {
                dateFromInput.addEventListener('change', function() {
                    dateToInput.min = this.value;
                });

                dateToInput.addEventListener('change', function() {
                    dateFromInput.max = this.value;
                });
            }
        }
    }
}
</script>
@endsection

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
