@extends('layouts.admin')

@section('page-title', 'Detail Anak - ' . $child->name)

@section('main-content')
<div class="space-y-6">
    <!-- Child Information -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Informasi Anak</h3>
        </div>
        <div class="p-6">
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    @if($child->photo)
                        <div class="mb-6">
                            <img src="{{ Storage::url($child->photo) }}" alt="{{ $child->name }}"
                                 class="w-32 h-32 object-cover rounded-lg">
                        </div>
                    @endif
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">NIK</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $child->nik }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $child->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jenis Kelamin</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $child->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Lahir</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $child->birth_date->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Umur Saat Ini</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $child->age_in_months }} bulan</p>
                        </div>
                    </div>
                </div>

                <!-- Latest Measurement -->
                <div>
                    @if($child->latest_measurement)
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Pengukuran Terakhir</h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tanggal:</span>
                                    <span>{{ $child->latest_measurement->measurement_date->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tinggi Badan:</span>
                                    <span>{{ $child->latest_measurement->height }} cm</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Z-Score:</span>
                                    <span>{{ $child->latest_measurement->z_score }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($child->latest_measurement->status == 'Sangat Pendek') bg-red-100 text-red-800
                                        @elseif($child->latest_measurement->status == 'Pendek') bg-orange-100 text-orange-800
                                        @elseif($child->latest_measurement->status == 'Normal') bg-green-100 text-green-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ $child->latest_measurement->status }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Petugas:</span>
                                    <span>{{ $child->latest_measurement->user ? $child->latest_measurement->user->name : 'Publik' }}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-gray-500">Belum ada pengukuran</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Measurements History -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Riwayat Pengukuran ({{ $measurements->count() }})</h3>
        </div>

        @if($measurements->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Umur (Bulan)
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tinggi (cm)
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Z-Score
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Petugas
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($measurements as $measurement)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $measurement->measurement_date->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $measurement->age_months }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $measurement->height }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $measurement->z_score }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    @if($measurement->status == 'Sangat Pendek') bg-red-100 text-red-800
                                    @elseif($measurement->status == 'Pendek') bg-orange-100 text-orange-800
                                    @elseif($measurement->status == 'Normal') bg-green-100 text-green-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ $measurement->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $measurement->user ? $measurement->user->name : 'Publik' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <p class="text-gray-500">Belum ada data pengukuran</p>
            </div>
        @endif
    </div>

    <!-- Actions -->
    <div class="flex gap-4">
        <a href="{{ route('admin.children') }}"
           class="bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-700 transition duration-300">
            Kembali ke Daftar
        </a>
        <a href="{{ route('stunting.history', $child->nik) }}"
           class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">
            Lihat di Halaman Publik
        </a>
    </div>
</div>
@endsection
