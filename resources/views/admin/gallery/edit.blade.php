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
                <form id="editGalleryForm" action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
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
                                    <img id="currentImage" src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}"
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
                            <div id="upload-area" class="border-2 border-dashed border-blue-300 rounded-xl bg-blue-50/50 hover:bg-blue-50 transition-colors duration-300 cursor-pointer"
                                 onclick="document.getElementById('image').click();">
                                <div class="p-6 text-center">
                                    <div class="mx-auto w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                    </div>
                                    <input type="file" id="image" name="image" accept="image/*"
                                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="handleFileSelect(this)">
                                    <p class="text-blue-700 font-semibold mb-1">Klik untuk pilih foto</p>
                                    <p class="text-gray-500 text-sm">atau drag & drop file di sini</p>
                                    <p class="text-xs text-gray-400 mt-2">Format: JPG, JPEG, PNG • Maksimal 2MB</p>
                                </div>
                            </div>

                            <!-- Preview Box for New Image -->
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
                        <button type="button" id="submitBtn"
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

<!-- Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
    <div class="relative p-8 border w-full max-w-lg mx-4 shadow-2xl rounded-3xl bg-white border-gray-200 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="text-center">
            <!-- Modal Icon -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 mb-6 shadow-xl">
                <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>

            <!-- Modal Title -->
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Konfirmasi Edit Foto</h3>

            <!-- Modal Content -->
            <div class="text-left bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-200">
                <p class="text-gray-700 mb-4 font-semibold">Anda akan memperbarui foto galeri dengan data:</p>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Judul:</span>
                        <span class="font-semibold text-gray-800" id="confirmTitle">-</span>
                    </div>
                    <div class="py-2 border-b border-gray-200">
                        <span class="text-gray-600">Deskripsi:</span>
                        <p class="text-gray-800 text-sm mt-1" id="confirmDescription">-</p>
                    </div>
                    <div class="py-2">
                        <span class="text-gray-600">Status Foto:</span>
                        <p class="text-gray-800 text-sm mt-1" id="confirmImageStatus">-</p>
                    </div>
                </div>

                <!-- Preview Image in Modal -->
                <div class="mt-4 p-4 bg-white border border-gray-200 rounded-xl">
                    <div class="flex justify-center">
                        <img id="confirmPreview" class="max-h-32 object-contain rounded-lg shadow-sm" src="" alt="Preview">
                    </div>
                </div>

                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-blue-800 font-semibold text-sm">Informasi</p>
                            <p class="text-blue-700 text-sm mt-1">Perubahan akan disimpan dan foto galeri akan diperbarui.</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-gray-600 mb-8 text-lg">Apakah Anda yakin ingin memperbarui foto ini?</p>

            <!-- Modal Actions -->
            <div class="flex gap-4">
                <button id="cancelBtn"
                        class="flex-1 bg-gray-100 text-gray-700 px-6 py-4 rounded-xl hover:bg-gray-200 transition-all duration-300 font-semibold border border-gray-200 hover:border-gray-300 transform hover:scale-105">
                    Batal
                </button>
                <button id="confirmBtn"
                        class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-semibold shadow-xl transform hover:scale-105">
                    Ya, Perbarui
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
let confirmModal, modalContent, submitBtn, cancelBtn, confirmBtn, editGalleryForm;
let selectedFile = null;

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

        selectedFile = file;
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
    const input = document.getElementById('image');
    const uploadArea = document.getElementById('upload-area');
    const previewArea = document.getElementById('preview-area');
    const previewImage = document.getElementById('preview-image');
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');

    selectedFile = null;
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
    const titleValue = document.getElementById('title').value.trim();
    const descriptionValue = document.getElementById('description').value.trim();

    // Check required fields
    if (!titleValue) {
        alert('Judul foto harus diisi!');
        document.getElementById('title').focus();
        return false;
    }

    if (!descriptionValue) {
        alert('Deskripsi foto harus diisi!');
        document.getElementById('description').focus();
        return false;
    }

    return true;
}

// Drag and Drop
document.addEventListener('DOMContentLoaded', () => {
    // Initialize modal elements
    confirmModal = document.getElementById('confirmModal');
    modalContent = document.getElementById('modalContent');
    submitBtn = document.getElementById('submitBtn');
    cancelBtn = document.getElementById('cancelBtn');
    confirmBtn = document.getElementById('confirmBtn');
    editGalleryForm = document.getElementById('editGalleryForm');

    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('image');

    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
        uploadArea.addEventListener(event, e => {
            e.preventDefault();
            e.stopPropagation();
        }, false);
    });

    ['dragenter', 'dragover'].forEach(event => {
        uploadArea.addEventListener(event, () => {
            uploadArea.classList.add('border-blue-500', 'bg-blue-50');
        });
    });

    ['dragleave', 'drop'].forEach(event => {
        uploadArea.addEventListener(event, () => {
            uploadArea.classList.remove('border-blue-500', 'bg-blue-50');
        });
    });

    uploadArea.addEventListener('drop', e => {
        const dt = e.dataTransfer;
        const files = dt.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect(fileInput);
        }
    });

    // Submit button click handler
    submitBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Validate form
        if (!validateForm()) {
            return;
        }

        // Get form values
        const titleValue = document.getElementById('title').value.trim();
        const descriptionValue = document.getElementById('description').value.trim();
        const currentImage = document.getElementById('currentImage');
        const previewImage = document.getElementById('preview-image');

        // Update modal content
        document.getElementById('confirmTitle').textContent = titleValue;
        document.getElementById('confirmDescription').textContent = descriptionValue;

        // Check if new image is selected
        if (selectedFile) {
            document.getElementById('confirmImageStatus').textContent = `Foto baru akan diupload: ${selectedFile.name} (${formatFileSize(selectedFile.size)})`;
            document.getElementById('confirmPreview').src = previewImage.src;
        } else {
            document.getElementById('confirmImageStatus').textContent = 'Menggunakan foto yang sudah ada';
            document.getElementById('confirmPreview').src = currentImage ? currentImage.src : '';
        }

        showConfirmModal();
    });

    // Cancel button
    cancelBtn.addEventListener('click', hideConfirmModal);

    // Confirm button
    confirmBtn.addEventListener('click', function() {
        // Show loading state
        confirmBtn.disabled = true;
        confirmBtn.innerHTML = '<span>Memperbarui...</span>';

        // Submit form
        editGalleryForm.submit();
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
