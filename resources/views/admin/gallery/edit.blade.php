@extends('layouts.admin')
@section('page-title', 'Edit Foto Galeri')
@section('main-content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-800 to-indigo-800 bg-clip-text text-transparent">
                    Edit Foto Galeri
                </h1>
            </div>
            <p class="text-gray-600 ml-11">Perbarui informasi dan foto galeri Anda</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl border border-blue-100 overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white">Form Edit Foto</h3>
                        <p class="text-blue-100 text-sm">Lengkapi formulir di bawah untuk memperbarui foto</p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Title Field -->
                    <div class="group">
                        <label for="title" class="flex items-center space-x-2 text-sm font-semibold text-gray-800 mb-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span>Judul Foto</span>
                        </label>
                        <div class="relative">
                            <input type="text" id="title" name="title" required
                                   class="w-full pl-4 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-gray-50 focus:bg-white text-gray-800 placeholder-gray-400"
                                   value="{{ old('title', $gallery->title) }}"
                                   placeholder="Masukkan judul foto yang menarik">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('title')
                            <div class="flex items-center space-x-2 mt-2">
                                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div class="group">
                        <label for="description" class="flex items-center space-x-2 text-sm font-semibold text-gray-800 mb-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span>Deskripsi</span>
                        </label>
                        <div class="relative">
                            <textarea id="description" name="description" rows="5" required
                                      class="w-full pl-4 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-gray-50 focus:bg-white text-gray-800 placeholder-gray-400 resize-none"
                                      placeholder="Berikan deskripsi yang menjelaskan foto ini...">{{ old('description', $gallery->description) }}</textarea>
                            <div class="absolute top-4 right-4">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                            </div>
                        </div>
                        @error('description')
                            <div class="flex items-center space-x-2 mt-2">
                                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <!-- Image Upload Section -->
                    <div class="group">
                        <label class="flex items-center space-x-2 text-sm font-semibold text-gray-800 mb-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span>Foto Galeri</span>
                        </label>

                        <!-- Current Image Display -->
                        @if($gallery->image)
                            <div class="mb-6">
                                <p class="text-sm text-gray-600 mb-3 font-medium">Foto Saat Ini:</p>
                                <div class="relative inline-block">
                                    <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}"
                                         class="w-64 h-40 object-cover rounded-xl shadow-lg border-4 border-white">
                                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- File Upload -->
                        <div class="relative">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-3">
                                Upload Foto Baru (Opsional)
                            </label>
                            <div class="border-2 border-dashed border-blue-300 rounded-xl bg-blue-50/50 hover:bg-blue-50 transition-colors duration-300">
                                <div class="p-6 text-center">
                                    <div class="mx-auto w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                    </div>
                                    <input type="file" id="image" name="image" accept="image/*"
                                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    <p class="text-blue-700 font-semibold mb-1">Klik untuk pilih foto</p>
                                    <p class="text-gray-500 text-sm">atau drag & drop file di sini</p>
                                    <p class="text-xs text-gray-400 mt-2">Format: JPG, JPEG, PNG • Maksimal 2MB</p>
                                </div>
                            </div>
                        </div>
                        @error('image')
                            <div class="flex items-center space-x-2 mt-2">
                                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-100">
                        <button type="submit"
                                class="flex-1 sm:flex-none bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            <span>Update Foto</span>
                        </button>
                        <a href="{{ route('admin.gallery.index') }}"
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

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-blue-900 mb-2">Tips Upload Foto</h4>
                        <p class="text-blue-700 text-sm">Gunakan foto dengan resolusi tinggi dan pastikan ukuran file tidak lebih dari 2MB untuk hasil terbaik.</p>
                    </div>
                </div>
            </div>
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-6">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-indigo-900 mb-2">Deskripsi yang Baik</h4>
                        <p class="text-indigo-700 text-sm">Buat deskripsi yang menarik dan informatif untuk meningkatkan engagement pengunjung galeri.</p>
                    </div>
                </div>
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
@endsection
