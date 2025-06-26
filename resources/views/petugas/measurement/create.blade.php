@extends('layouts.admin')

@section('page-title', 'Pengukuran Baru')

@section('main-content')
<div class="max-w-3xl">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Form Pengukuran Stunting</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('petugas.measurement.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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

                <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                    <div class="flex">
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Catatan Penting:</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc list-inside">
                                    <li>Pastikan pengukuran tinggi badan dilakukan dengan tepat</li>
                                    <li>Sistem ini untuk anak usia 0-60 bulan</li>
                                    <li>Data akan disimpan dalam sistem untuk tracking pertumbuhan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition duration-300 font-medium">
                        Lakukan Pengukuran
                    </button>
                    <a href="{{ route('petugas.dashboard') }}"
                       class="bg-gray-300 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-400 transition duration-300 font-medium">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
