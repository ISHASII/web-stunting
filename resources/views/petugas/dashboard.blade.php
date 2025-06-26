@extends('layouts.admin')

@section('page-title', 'Dashboard Petugas')

@section('main-content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                        <span class="text-white text-lg">📊</span>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Pengukuran Saya</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $myMeasurements }}</dd>
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
                        <span class="text-white text-lg">📅</span>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Pengukuran Hari Ini</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $todayMeasurements }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white shadow rounded-lg mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Menu Utama</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('petugas.measurement.create') }}"
               class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-300">
                <div class="flex-shrink-0 w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                    <span class="text-white">📏</span>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">Pengukuran Baru</p>
                    <p class="text-sm text-gray-500">Lakukan pengukuran stunting anak</p>
                </div>
            </a>

            <a href="{{ route('petugas.measurement.history') }}"
               class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition duration-300">
                <div class="flex-shrink-0 w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                    <span class="text-white">📋</span>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">Riwayat Pengukuran</p>
                    <p class="text-sm text-gray-500">Lihat pengukuran yang telah dilakukan</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Info -->
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Informasi</h3>
    </div>
    <div class="p-6">
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
            <div class="flex">
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Selamat datang, {{ auth()->user()->name }}!</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Anda dapat melakukan pengukuran stunting anak dan melihat riwayat pengukuran yang telah dilakukan.</p>
                        <ul class="mt-2 list-disc list-inside">
                            <li>Pastikan data yang dimasukkan akurat</li>
                            <li>Sistem menggunakan standar WHO untuk perhitungan Z-Score</li>
                            <li>Konsultasikan hasil dengan tenaga medis jika diperlukan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
