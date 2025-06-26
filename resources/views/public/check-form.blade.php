@extends('layouts.public')

@section('title', 'Cek Status Stunting - Sistem Deteksi Stunting')

@section('main-content')
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                    Form Pendeteksian Stunting
                </h1>

                <form action="{{ route('stunting.check') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK Anak</label>
                            <input type="text" id="nik" name="nik" required maxlength="16"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ old('nik') }}">
                            @error('nik')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ old('name') }}">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                            <select id="gender" name="gender" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" id="birth_date" name="birth_date" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ old('birth_date') }}">
                            @error('birth_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="height" class="block text-sm font-medium text-gray-700 mb-2">Tinggi Badan (cm)</label>
                        <input type="number" id="height" name="height" required step="0.1" min="30" max="150"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('height') }}">
                        @error('height')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Foto Anak (Opsional)</label>
                        <input type="file" id="photo" name="photo" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB</p>
                        @error('photo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex gap-4">
                        <button type="submit"
                                class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 transition duration-300 font-medium">
                            Analisis Status Gizi
                        </button>
                        <a href="{{ route('home') }}"
                           class="flex-1 bg-gray-300 text-gray-700 py-3 px-6 rounded-md hover:bg-gray-400 transition duration-300 font-medium text-center">
                            Kembali
                        </a>
                    </div>
                </form>

                <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                    <h3 class="font-semibold text-blue-800 mb-2">Informasi Penting:</h3>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• Sistem ini menggunakan standar WHO untuk anak usia 0-60 bulan</li>
                        <li>• Pastikan data yang dimasukkan akurat untuk hasil yang tepat</li>
                        <li>• Hasil ini adalah screening awal, konsultasi dengan tenaga kesehatan tetap diperlukan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
