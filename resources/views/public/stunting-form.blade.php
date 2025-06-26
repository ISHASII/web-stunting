@extends('layouts.public')

@section('title', 'Hasil Analisis - Sistem Deteksi Stunting')

@section('main-content')
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Hasil Analisis Status Gizi</h1>
                <p class="text-gray-600">Berdasarkan standar WHO untuk anak usia 0-60 bulan</p>
            </div>

            <!-- Main Result Card -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Child Info -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Data Anak</h2>
                        @if($child->photo)
                            <div class="mb-4">
                                <img src="{{ Storage::url($child->photo) }}" alt="Foto {{ $child->name }}"
                                     class="w-32 h-32 object-cover rounded-lg">
                            </div>
                        @endif
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">NIK:</span>
                                <span class="font-medium">{{ $child->nik }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nama:</span>
                                <span class="font-medium">{{ $child->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Jenis Kelamin:</span>
                                <span class="font-medium">{{ $child->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Lahir:</span>
                                <span class="font-medium">{{ $child->birth_date->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Umur:</span>
                                <span class="font-medium">{{ $latestMeasurement->age_months }} bulan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Result -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Hasil Pengukuran</h2>
                        <div class="space-y-4">
                            <div class="text-center p-6 rounded-lg
                                @if($latestMeasurement->status == 'Sangat Pendek') bg-red-100 border border-red-300
                                @elseif($latestMeasurement->status == 'Pendek') bg-orange-100 border border-orange-300
                                @elseif($latestMeasurement->status == 'Normal') bg-green-100 border border-green-300
                                @else bg-blue-100 border border-blue-300 @endif">

                                <div class="text-3xl font-bold mb-2
                                    @if($latestMeasurement->status == 'Sangat Pendek') text-red-600
                                    @elseif($latestMeasurement->status == 'Pendek') text-orange-600
                                    @elseif($latestMeasurement->status == 'Normal') text-green-600
                                    @else text-blue-600 @endif">
                                    {{ $latestMeasurement->status }}
                                </div>

                                <div class="text-lg text-gray-700">
                                    Z-Score: <span class="font-bold">{{ $latestMeasurement->z_score }}</span>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tinggi Badan:</span>
                                    <span class="font-medium">{{ $latestMeasurement->height }} cm</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tanggal Pengukuran:</span>
                                    <span class="font-medium">{{ $latestMeasurement->measurement_date->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interpretation -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Interpretasi Hasil</h2>

                @if($latestMeasurement->status == 'Sangat Pendek')
                    <div class="bg-red-50 border-l-4 border-red-400 p-4">
                        <div class="flex">
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Status: Sangat Pendek (Severely Stunted)</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <p>Anak mengalami stunting berat. Segera konsultasi dengan tenaga kesehatan untuk penanganan intensif.</p>
                                    <ul class="mt-2 list-disc list-inside">
                                        <li>Perbaiki pola makan dengan gizi seimbang</li>
                                        <li>Berikan ASI eksklusif (jika masih menyusui)</li>
                                        <li>Pantau pertumbuhan secara rutin</li>
                                        <li>Konsultasi dengan ahli gizi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($latestMeasurement->status == 'Pendek')
                    <div class="bg-orange-50 border-l-4 border-orange-400 p-4">
                        <div class="flex">
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-orange-800">Status: Pendek (Stunted)</h3>
                                <div class="mt-2 text-sm text-orange-700">
                                    <p>Anak mengalami stunting. Perlu perhatian khusus untuk memperbaiki status gizi.</p>
                                    <ul class="mt-2 list-disc list-inside">
                                        <li>Tingkatkan asupan gizi berkualitas</li>
                                        <li>Berikan makanan bergizi seimbang</li>
                                        <li>Pantau tumbuh kembang secara berkala</li>
                                        <li>Konsultasi dengan petugas kesehatan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($latestMeasurement->status == 'Normal')
                    <div class="bg-green-50 border-l-4 border-green-400 p-4">
                        <div class="flex">
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-green-800">Status: Normal</h3>
                                <div class="mt-2 text-sm text-green-700">
                                    <p>Pertumbuhan anak normal sesuai dengan standar WHO. Pertahankan pola hidup sehat.</p>
                                    <ul class="mt-2 list-disc list-inside">
                                        <li>Lanjutkan pemberian makanan bergizi</li>
                                        <li>Pantau pertumbuhan secara rutin</li>
                                        <li>Jaga kebersihan dan sanitasi</li>
                                        <li>Berikan stimulasi tumbuh kembang</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                        <div class="flex">
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Status: Tinggi</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <p>Tinggi badan anak di atas rata-rata. Pastikan pertumbuhan seimbang dengan berat badan.</p>
                                    <ul class="mt-2 list-disc list-inside">
                                        <li>Pantau keseimbangan tinggi dan berat badan</li>
                                        <li>Berikan aktivitas fisik yang sesuai</li>
                                        <li>Jaga pola makan bergizi seimbang</li>
                                        <li>Konsultasi rutin dengan tenaga kesehatan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('stunting.history', $child->nik) }}"
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                    Lihat Riwayat Pengukuran
                </a>
                <a href="{{ route('stunting.form') }}"
                   class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-300">
                    Ukur Anak Lain
                </a>
                <a href="{{ route('home') }}"
                   class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition duration-300">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
