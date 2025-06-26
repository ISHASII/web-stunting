@extends('layouts.admin')

@section('page-title', 'Dashboard Admin')

@section('main-content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                        <span class="text-white text-lg">👶</span>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Anak</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $totalChildren }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                        <span class="text-white text-lg">📊</span>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Pengukuran</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $totalMeasurements }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                        <span class="text-white text-lg">👨‍⚕️</span>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Petugas</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $totalPetugas }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-red-500 rounded-md flex items-center justify-center">
                        <span class="text-white text-lg">⚠️</span>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Anak Stunting</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stuntedChildren }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white shadow rounded-lg mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Aksi Cepat</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.children') }}"
               class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-300">
                <div class="flex-shrink-0 w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                    <span class="text-white">👶</span>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">Kelola Data Anak</p>
                    <p class="text-sm text-gray-500">Lihat dan kelola data anak</p>
                </div>
            </a>

            <a href="{{ route('admin.petugas.create') }}"
               class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition duration-300">
                <div class="flex-shrink-0 w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                    <span class="text-white">👨‍⚕️</span>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">Tambah Petugas</p>
                    <p class="text-sm text-gray-500">Buat akun petugas baru</p>
                </div>
            </a>

            <a href="{{ route('admin.gallery.create') }}"
               class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition duration-300">
                <div class="flex-shrink-0 w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                    <span class="text-white">🖼️</span>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">Tambah Galeri</p>
                    <p class="text-sm text-gray-500">Upload foto kegiatan</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Aktivitas Terbaru</h3>
    </div>
    <div class="p-6">
        <div class="flow-root">
            <ul class="-mb-8">
                <li>
                    <div class="relative pb-8">
                        <div class="relative flex space-x-3">
                            <div>
                                <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                    <span class="text-white text-sm">✓</span>
                                </span>
                            </div>
                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                <div>
                                    <p class="text-sm text-gray-500">Sistem berhasil diinisialisasi</p>
                                </div>
                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                    <time datetime="{{ now() }}">{{ now()->format('d/m/Y H:i') }}</time>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
