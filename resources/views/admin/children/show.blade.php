@extends('layouts.admin')

@section('page-title', 'Detail Anak - ' . $child->name)

@section('main-content')
<div class="space-y-6 m-6">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.children') }}"
                   class="p-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Anak</h1>
                    <p class="text-gray-600 mt-1">Informasi lengkap dan riwayat pengukuran {{ $child->name }}</p>
                </div>
            </div>
        </div>

        <!-- Export Actions - Individual Child Export -->
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.child.export', ['child' => $child->id, 'format' => 'excel']) }}"
               class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow-sm text-sm font-medium hover:bg-green-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                </svg>
                Export Excel
            </a>

            <a href="{{ route('admin.child.export', ['child' => $child->id, 'format' => 'pdf']) }}"
               class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg shadow-sm text-sm font-medium hover:bg-red-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                </svg>
                Export PDF
            </a>
        </div>
    </div>

    <!-- Child Information Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
            <h3 class="text-xl font-semibold text-white flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Informasi Anak
            </h3>
        </div>

        <div class="p-6">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Photo Section -->
                <div class="flex flex-col items-center">
                    @if($child->photo)
                        <div class="relative">
                            <img src="{{ Storage::url($child->photo) }}" alt="{{ $child->name }}"
                                 class="w-40 h-40 object-cover rounded-full ring-4 ring-blue-100 shadow-lg">
                            <div class="absolute -bottom-2 -right-2 bg-green-500 rounded-full p-2">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    @else
                        <div class="w-40 h-40 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center ring-4 ring-blue-100 shadow-lg">
                            <span class="text-white text-4xl font-bold">{{ substr($child->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <h2 class="mt-4 text-2xl font-bold text-gray-900 text-center">{{ $child->name }}</h2>
                    <p class="text-gray-500 font-medium">{{ $child->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>

                <!-- Basic Information -->
                <div class="lg:col-span-2">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="block text-sm font-semibold text-gray-600 mb-2">NIK</label>
                                <p class="text-lg font-mono text-gray-900 bg-white px-3 py-2 rounded border">{{ $child->nik }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Tanggal Lahir</label>
                                <p class="text-lg text-gray-900 bg-white px-3 py-2 rounded border">{{ $child->birth_date->format('d F Y') }}</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Umur Saat Ini</label>
                                <p class="text-lg text-gray-900 bg-white px-3 py-2 rounded border">{{ $child->age_in_months }} bulan</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Total Pengukuran</label>
                                <p class="text-lg text-gray-900 bg-white px-3 py-2 rounded border">{{ $measurements->count() }} kali</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Measurement Card -->
    @if($child->latest_measurement)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
            <h3 class="text-xl font-semibold text-white flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Pengukuran Terakhir
            </h3>
        </div>

        <div class="p-6">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-blue-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-blue-700">{{ $child->latest_measurement->measurement_date->format('d/m/Y') }}</div>
                    <div class="text-sm text-blue-600 font-medium">Tanggal Pengukuran</div>
                </div>

                <div class="bg-purple-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-purple-700">{{ $child->latest_measurement->height }} cm</div>
                    <div class="text-sm text-purple-600 font-medium">Tinggi Badan</div>
                </div>

                <div class="bg-orange-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-orange-700">{{ number_format($child->latest_measurement->z_score, 2) }}</div>
                    <div class="text-sm text-orange-600 font-medium">Z-Score</div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 text-center">
                    <div class="flex flex-col items-center">
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full mb-2
                            @if($child->latest_measurement->status == 'Sangat Pendek') bg-red-100 text-red-800
                            @elseif($child->latest_measurement->status == 'Pendek') bg-orange-100 text-orange-800
                            @elseif($child->latest_measurement->status == 'Normal') bg-green-100 text-green-800
                            @else bg-blue-100 text-blue-800 @endif">
                            {{ $child->latest_measurement->status }}
                        </span>
                        <div class="text-xs text-gray-600">Status Gizi</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 bg-gray-50 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <span class="text-gray-600 font-medium">Petugas yang mengukur:</span>
                    <span class="text-gray-900 font-semibold">{{ $child->latest_measurement->user ? $child->latest_measurement->user->name : 'Publik' }}</span>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-500 to-gray-600 px-6 py-4">
            <h3 class="text-xl font-semibold text-white">Pengukuran Terakhir</h3>
        </div>
        <div class="p-8 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <p class="text-gray-500 text-lg">Belum ada pengukuran</p>
            <p class="text-gray-400 text-sm mt-2">Silakan tambahkan pengukuran untuk anak ini</p>
        </div>
    </div>
    @endif

    <!-- Measurements History -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Riwayat Pengukuran
                </h3>
                <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                    {{ $measurements->count() }} pengukuran
                </span>
            </div>
        </div>

        @if($measurements->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Tanggal
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Umur (Bulan)
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tinggi (cm)
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Z-Score
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Petugas
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($measurements as $index => $measurement)
                        <tr class="hover:bg-gray-50 transition-colors {{ $index === 0 ? 'bg-blue-50/50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($index === 0)
                                        <div class="bg-blue-100 p-1 rounded-full mr-2">
                                            <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $measurement->measurement_date->format('d/m/Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $measurement->measurement_date->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $measurement->age_months }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $measurement->height }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ number_format($measurement->z_score, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full
                                    @if($measurement->status == 'Sangat Pendek') bg-red-100 text-red-800
                                    @elseif($measurement->status == 'Pendek') bg-orange-100 text-orange-800
                                    @elseif($measurement->status == 'Normal') bg-green-100 text-green-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    @if($measurement->status == 'Normal')
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    {{ $measurement->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <div class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center">
                                            <span class="text-xs font-medium text-gray-600">
                                                {{ $measurement->user ? substr($measurement->user->name, 0, 1) : 'P' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">
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
            <div class="px-6 py-16 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada data pengukuran</h3>
                <p class="mt-2 text-gray-500">Mulai dengan menambahkan pengukuran pertama untuk anak ini.</p>
                <div class="mt-6">
                    <a href="{{ route('petugas.measurement.create') }}?child_id={{ $child->id }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Pengukuran
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="flex flex-wrap gap-4">
        <a href="{{ route('admin.children') }}"
           class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar
        </a>
    </div>
</div>
@endsection
