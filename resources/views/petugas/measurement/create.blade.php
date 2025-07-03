@extends('layouts.admin')

@section('page-title', 'Pengukuran Baru')

@section('main-content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-800 to-indigo-800 bg-clip-text text-transparent">
                    Pengukuran Baru
                </h1>
            </div>
            <p class="text-gray-600 ml-11">Lakukan pengukuran stunting untuk anak dengan sistem standar WHO</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl border border-blue-100 overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white">Form Pengukuran Stunting</h3>
                        <p class="text-blue-100 text-sm">Lengkapi data anak untuk proses pengukuran</p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form id="measurementForm" action="{{ route('petugas.measurement.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Personal Information Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <h4 class="text-lg font-semibold text-gray-800">Informasi Pribadi</h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- NIK Field -->
                            <div class="group">
                                <label for="nik" class="flex items-center space-x-2 text-sm font-semibold text-gray-800 mb-3">
                                    <span>NIK Anak</span>
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" id="nik" name="nik" required maxlength="16"
                                           class="w-full pl-4 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-gray-50 focus:bg-white text-gray-800 placeholder-gray-400"
                                           value="{{ old('nik') }}"
                                           placeholder="Masukkan NIK 16 digit"
                                           oninput="this.value = this.value.replace(/\D/g, '')">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-4 0V4a2 2 0 014 0v2"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('nik')
                                    <div class="flex items-center space-x-2 mt-2">
                                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <!-- Name Field -->
                            <div class="group">
                                <label for="name" class="flex items-center space-x-2 text-sm font-semibold text-gray-800 mb-3">
                                    <span>Nama Lengkap</span>
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" id="name" name="name" required
                                           class="w-full pl-4 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-gray-50 focus:bg-white text-gray-800 placeholder-gray-400"
                                           value="{{ old('name') }}"
                                           placeholder="Masukkan nama lengkap anak">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('name')
                                    <div class="flex items-center space-x-2 mt-2">
                                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Gender Field -->
                            <div class="group">
                                <label for="gender" class="flex items-center space-x-2 text-sm font-semibold text-gray-800 mb-3">
                                    <span>Jenis Kelamin</span>
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select id="gender" name="gender" required
                                            class="w-full pl-4 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-gray-50 focus:bg-white text-gray-800 appearance-none">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('gender')
                                    <div class="flex items-center space-x-2 mt-2">
                                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <!-- Birth Date Field -->
                            <div class="group">
                                <label for="birth_date" class="flex items-center space-x-2 text-sm font-semibold text-gray-800 mb-3">
                                    <span>Tanggal Lahir</span>
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="date" id="birth_date" name="birth_date" required
                                           class="w-full pl-4 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-gray-50 focus:bg-white text-gray-800"
                                           value="{{ old('birth_date') }}">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v8a1 1 0 01-1 1H5a1 1 0 01-1-1V8a1 1 0 011-1h3z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('birth_date')
                                    <div class="flex items-center space-x-2 mt-2">
                                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Measurement Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <h4 class="text-lg font-semibold text-gray-800">Data Pengukuran</h4>
                        </div>

                        <!-- Height Field -->
                        <div class="group">
                            <label for="height" class="flex items-center space-x-2 text-sm font-semibold text-gray-800 mb-3">
                                <span>Tinggi Badan (cm)</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" id="height" name="height" required step="0.1" min="30" max="150"
                                       class="w-full pl-4 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-gray-50 focus:bg-white text-gray-800 placeholder-gray-400"
                                       value="{{ old('height') }}"
                                       placeholder="Contoh: 85.5">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    <span class="text-gray-500 text-sm font-medium">cm</span>
                                </div>
                            </div>
                            @error('height')
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <!-- Weight Field -->
                        <div class="group">
                            <label for="weight" class="flex items-center space-x-2 text-sm font-semibold text-gray-800 mb-3">
                                <span>Berat Badan (kg)</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" id="weight" name="weight" required step="0.1" min="1" max="50"
                                       class="w-full pl-4 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-gray-50 focus:bg-white text-gray-800 placeholder-gray-400"
                                       value="{{ old('weight') }}"
                                       placeholder="Contoh: 12.5">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    <span class="text-gray-500 text-sm font-medium">kg</span>
                                </div>
                            </div>
                            @error('weight')
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <!-- Photo Upload Section -->
                        <div class="group">
                            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-800 mb-3">
                                <span>Foto Anak (Opsional)</span>
                            </label>
                            <div class="relative">
                                <input type="file" id="photo" name="photo" accept="image/*" class="hidden">
                                <div id="upload-area" class="border-2 border-dashed border-blue-300 rounded-xl bg-blue-50/50 hover:bg-blue-50 transition-colors duration-300 cursor-pointer">
                                    <div class="p-6 text-center">
                                        <div class="mx-auto w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                        </div>
                                        <p class="text-blue-700 font-semibold mb-1">Klik untuk pilih foto</p>
                                        <p class="text-gray-500 text-sm">atau drag & drop file di sini</p>
                                        <p class="text-xs text-gray-400 mt-2">Format: JPG, JPEG, PNG • Maksimal 2MB</p>
                                    </div>
                                </div>

                                <!-- Preview Box -->
                                <div id="preview-area" class="hidden border-2 border-dashed border-blue-300 rounded-xl p-4 bg-white space-y-4 mt-4">
                                    <div class="flex justify-center">
                                        <img id="preview-image" class="max-h-48 object-contain rounded-lg shadow-md" src="" alt="Preview Image">
                                    </div>
                                    <div class="flex justify-between items-center px-4 py-2 bg-blue-50 rounded-xl border border-blue-200">
                                        <div>
                                            <p id="file-name" class="text-sm font-semibold text-blue-900 truncate max-w-[200px]"></p>
                                            <p id="file-size" class="text-xs text-blue-600"></p>
                                        </div>
                                        <button type="button" onclick="removeFile()"
                                                class="text-red-600 hover:text-red-800 transition duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @error('photo')
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Important Notes -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border-l-4 border-blue-500 rounded-2xl overflow-hidden">
                        <!-- Header -->
                        <div class="bg-blue-100/50 px-4 py-3 sm:px-6">
                            <div class="flex items-center justify-center sm:justify-start space-x-3">
                                <div class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <h4 class="text-sm sm:text-base font-semibold text-blue-800">Catatan Penting</h4>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="px-4 py-4 sm:px-6 sm:py-5">
                            <div class="space-y-3 sm:space-y-2">
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                                    <p class="text-sm text-blue-700 leading-relaxed">
                                        Pastikan pengukuran tinggi badan dilakukan dengan tepat dan akurat
                                    </p>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                                    <p class="text-sm text-blue-700 leading-relaxed">
                                        Sistem ini diperuntukkan untuk anak usia 0-60 bulan
                                    </p>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                                    <p class="text-sm text-blue-700 leading-relaxed">
                                        Data akan disimpan dalam sistem untuk tracking pertumbuhan anak
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-100">
                        <button type="button" id="submitBtn"
                                class="flex-1 sm:flex-none bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                            </svg>
                            <span>Lakukan Pengukuran</span>
                        </button>
                        <a href="{{ route('petugas.dashboard') }}"
                           class="flex-1 sm:flex-none bg-white text-gray-700 px-8 py-4 rounded-xl font-semibold hover:bg-gray-50 border-2 border-gray-200 hover:border-gray-300 transition-all duration-300 flex items-center justify-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>Kembali</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
    <div class="relative p-8 border w-full max-w-lg mx-4 shadow-2xl rounded-3xl bg-white border-gray-200 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="text-center">
            <!-- Modal Icon -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 mb-6 shadow-xl">
                <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                </svg>
            </div>

            <!-- Modal Title -->
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Konfirmasi Pengukuran</h3>

            <!-- Modal Content -->
            <div class="text-left bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-200">
                <p class="text-gray-700 mb-4 font-semibold">Anda akan menambahkan data pengukuran dengan informasi:</p>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">NIK:</span>
                        <span class="font-semibold text-gray-800" id="confirmNik">-</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Nama:</span>
                        <span class="font-semibold text-gray-800" id="confirmName">-</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Jenis Kelamin:</span>
                        <span class="font-semibold text-gray-800" id="confirmGender">-</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Tanggal Lahir:</span>
                        <span class="font-semibold text-gray-800" id="confirmBirthDate">-</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Tinggi Badan:</span>
                        <span class="font-semibold text-gray-800" id="confirmHeight">-</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-600">Berat Badan:</span>
                        <span class="font-semibold text-gray-800" id="confirmWeight">-</span>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-blue-800 font-semibold text-sm">Informasi</p>
                            <p class="text-blue-700 text-sm mt-1">Data akan diproses menggunakan standar WHO untuk menentukan status gizi anak.</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-gray-600 mb-8 text-lg">Apakah data yang dimasukkan sudah benar?</p>

            <!-- Modal Actions -->
            <div class="flex gap-4">
                <button id="cancelBtn"
                        class="flex-1 bg-gray-100 text-gray-700 px-6 py-4 rounded-xl hover:bg-gray-200 transition-all duration-300 font-semibold border border-gray-200 hover:border-gray-300 transform hover:scale-105">
                    Periksa Kembali
                </button>
                <button id="confirmBtn"
                        class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-semibold shadow-xl transform hover:scale-105">
                    Ya, Lakukan Pengukuran
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .group:hover .group-hover\:scale-105 {
        transform: scale(1.05);
    }

    input[type="file"]::-webkit-file-upload-button {
        display: none;
    }

    input[type="file"]::file-selector-button {
        display: none;
    }
</style>

<script>
// Global variables for modal
let confirmModal, modalContent, submitBtn, cancelBtn, confirmBtn, measurementForm;

function handleFileSelect(input) {
    const file = input.files[0];
    const uploadArea = document.getElementById('upload-area');
    const previewArea = document.getElementById('preview-area');
    const previewImage = document.getElementById('preview-image');
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');

    if (file) {
        // Validate file size (2MB limit)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar! Maksimal 2MB.');
            input.value = '';
            return;
        }

        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            alert('Format file tidak didukung! Gunakan JPG, JPEG, atau PNG.');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            uploadArea.classList.add('hidden');
            previewArea.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function removeFile() {
    const input = document.getElementById('photo');
    const uploadArea = document.getElementById('upload-area');
    const previewArea = document.getElementById('preview-area');
    const previewImage = document.getElementById('preview-image');
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');

    input.value = '';
    previewImage.src = '';
    fileName.textContent = '';
    fileSize.textContent = '';
    uploadArea.classList.remove('hidden');
    previewArea.classList.add('hidden');
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Handle drag and drop files
function handleDragDrop(files) {
    const fileInput = document.getElementById('photo');

    if (files.length > 0) {
        const file = files[0];

        // Create a new DataTransfer object and add the file
        const dt = new DataTransfer();
        dt.items.add(file);
        fileInput.files = dt.files;

        // Trigger the file selection handler
        handleFileSelect(fileInput);
    }
}

// Show confirmation modal
function showConfirmModal() {
    confirmModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

// Hide confirmation modal
function hideConfirmModal() {
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        confirmModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }, 300);
}

// Form validation function
function validateForm() {
    const nikValue = document.getElementById('nik').value.trim();
    const nameValue = document.getElementById('name').value.trim();
    const genderValue = document.getElementById('gender').value;
    const birthDateValue = document.getElementById('birth_date').value;
    const heightValue = document.getElementById('height').value;

    // Check required fields
    if (!nikValue) {
        alert('NIK harus diisi!');
        document.getElementById('nik').focus();
        return false;
    }

    if (nikValue.length !== 16) {
        alert('NIK harus 16 digit!');
        document.getElementById('nik').focus();
        return false;
    }

    if (!nameValue) {
        alert('Nama lengkap harus diisi!');
        document.getElementById('name').focus();
        return false;
    }

    if (!genderValue) {
        alert('Jenis kelamin harus dipilih!');
        document.getElementById('gender').focus();
        return false;
    }

    if (!birthDateValue) {
        alert('Tanggal lahir harus diisi!');
        document.getElementById('birth_date').focus();
        return false;
    }

    if (!heightValue) {
        alert('Tinggi badan harus diisi!');
        document.getElementById('height').focus();
        return false;
    }

    if (heightValue < 30 || heightValue > 150) {
        alert('Tinggi badan harus antara 30-150 cm!');
        document.getElementById('height').focus();
        return false;
    }

    const weightValue = document.getElementById('weight').value;
    if (!weightValue) {
        alert('Berat badan harus diisi!');
        document.getElementById('weight').focus();
        return false;
    }

    if (weightValue < 1 || weightValue > 50) {
        alert('Berat badan harus antara 1-50 kg!');
        document.getElementById('weight').focus();
        return false;
    }

    return true;
}

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize modal elements
    confirmModal = document.getElementById('confirmModal');
    modalContent = document.getElementById('modalContent');
    submitBtn = document.getElementById('submitBtn');
    cancelBtn = document.getElementById('cancelBtn');
    confirmBtn = document.getElementById('confirmBtn');
    measurementForm = document.getElementById('measurementForm');

    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('photo');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    uploadArea.addEventListener('drop', handleDrop, false);

    // Handle click to open file dialog
    uploadArea.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        fileInput.click();
    });

    // Handle file input change
    fileInput.addEventListener('change', function(e) {
        e.stopPropagation();
        handleFileSelect(this);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight(e) {
        uploadArea.classList.add('border-blue-500', 'bg-blue-50');
    }

    function unhighlight(e) {
        uploadArea.classList.remove('border-blue-500', 'bg-blue-50');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleDragDrop(files);
    }

    // Submit button click handler
    submitBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Validate form
        if (!validateForm()) {
            return;
        }

        // Get form values
        const nikValue = document.getElementById('nik').value.trim();
        const nameValue = document.getElementById('name').value.trim();
        const genderValue = document.getElementById('gender').value;
        const birthDateValue = document.getElementById('birth_date').value;
        const heightValue = document.getElementById('height').value;
        const weightValue = document.getElementById('weight').value;

        // Update modal content
        document.getElementById('confirmNik').textContent = nikValue;
        document.getElementById('confirmName').textContent = nameValue;
        document.getElementById('confirmGender').textContent = genderValue === 'L' ? 'Laki-laki' : 'Perempuan';
        document.getElementById('confirmBirthDate').textContent = new Date(birthDateValue).toLocaleDateString('id-ID');
        document.getElementById('confirmHeight').textContent = heightValue + ' cm';
        document.getElementById('confirmWeight').textContent = weightValue + ' kg';

        showConfirmModal();
    });

    // Cancel button
    cancelBtn.addEventListener('click', hideConfirmModal);

    // Confirm button
    confirmBtn.addEventListener('click', function() {
        // Show loading state
        confirmBtn.disabled = true;
        confirmBtn.innerHTML = '<span>Memproses...</span>';

        // Submit form
        measurementForm.submit();
    });

    // Close modal when clicking outside
    confirmModal.addEventListener('click', function(e) {
        if (e.target === confirmModal) {
            hideConfirmModal();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !confirmModal.classList.contains('hidden')) {
            hideConfirmModal();
        }
    });
});
</script>
@endsection
