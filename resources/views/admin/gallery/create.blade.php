@extends('layouts.admin')

@section('page-title', 'Tambah Foto Galeri')

@section('main-content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl p-6 m-5 shadow-lg">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.gallery.index') }}"
           class="bg-white/20 hover:bg-white/30 text-white p-2 rounded-lg transition duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white mb-1">Tambah Foto Galeri</h1>
            <p class="text-blue-100 text-sm">Unggah foto baru ke galeri kegiatan</p>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto">
    <div class="bg-white m-5 shadow-xl rounded-2xl border border-blue-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-5 sm:px-8 sm:py-6 border-b border-blue-200">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 p-3 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-blue-900">Form Tambah Foto</h3>
                    <p class="text-blue-600 text-sm">Lengkapi informasi foto yang akan diunggah</p>
                </div>
            </div>
        </div>

        <div class="px-4 py-8 sm:px-6 lg:px-10">
            <form id="galleryForm" action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data"
                  class="grid grid-cols-1 gap-y-10 gap-x-8 lg:grid-cols-2">
                @csrf

                <!-- Left Column -->
                <div class="space-y-8">
                    <!-- Title -->
                    <div class="space-y-3">
                        <label for="title" class="block text-sm font-semibold text-blue-900">Judul Foto</label>
                        <input type="text" id="title" name="title" required
                               class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition duration-300 text-blue-900 placeholder-blue-300"
                               placeholder="Masukkan judul foto..." value="{{ old('title') }}">
                        @error('title')
                        <div class="text-red-600 text-sm mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                      clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="space-y-3">
                        <label for="description" class="block text-sm font-semibold text-blue-900">Deskripsi</label>
                        <textarea id="description" name="description" rows="6" required
                                  class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition duration-300 text-blue-900 placeholder-blue-300 resize-none"
                                  placeholder="Berikan deskripsi tentang foto ini...">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="text-red-600 text-sm mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                      clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- Right Column (Upload Area) -->
                <div class="space-y-8">
                    <div class="space-y-3">
                        <label for="image" class="block text-sm font-semibold text-blue-900">Upload Foto</label>
                        <div class="relative">
                            <input type="file" id="image" name="image" accept="image/*" required
                                class="hidden" onchange="handleFileSelect(this)">

                            <!-- Upload Box -->
                            <div id="upload-area"
                                 onclick="document.getElementById('image').click();"
                                 class="border-2 border-dashed border-blue-300 rounded-xl p-8 text-center hover:border-blue-500 hover:bg-blue-50 transition duration-300 cursor-pointer h-64 flex flex-col items-center justify-center gap-4">
                                <!-- Icon + Text -->
                                <div class="bg-blue-100 p-4 rounded-full">
                                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-blue-900 font-semibold">Klik untuk pilih foto</p>
                                    <p class="text-blue-600 text-sm">atau drag & drop file di sini</p>
                                </div>
                                <div class="bg-blue-100 px-4 py-2 rounded-md">
                                    <p class="text-blue-700 text-xs font-medium">Format: JPG, JPEG, PNG • Maksimal 2MB</p>
                                </div>
                            </div>

                            <!-- Preview Box -->
                            <div id="preview-area"
                                 class="hidden border-2 border-dashed border-blue-300 rounded-xl p-4 bg-white space-y-4 mt-4">
                                <div class="flex justify-center">
                                    <img id="preview-image"
                                         class="max-h-48 object-contain rounded-lg shadow-md" src=""
                                         alt="Preview Image">
                                </div>
                                <div class="flex justify-between items-center px-4 py-2 bg-blue-50 rounded-xl border border-blue-200">
                                    <div>
                                        <p id="file-name"
                                           class="text-sm font-semibold text-blue-900 truncate max-w-[200px]"></p>
                                        <p id="file-size" class="text-xs text-blue-600"></p>
                                    </div>
                                    <button type="button" onclick="removeFile()"
                                            class="text-red-600 hover:text-red-800 transition duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @error('image')
                        <div class="text-red-600 text-sm mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                      clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="lg:col-span-2">
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-blue-100">
                        <button type="button" id="submitBtn"
                                class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-xl font-semibold hover:from-blue-700 hover:to-blue-800 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Foto
                        </button>
                        <a href="{{ route('admin.gallery.index') }}"
                           class="w-full sm:w-auto bg-gray-100 text-gray-700 px-6 py-4 rounded-xl font-semibold hover:bg-gray-200 transition duration-300 text-center flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                    </div>
                </div>
            </form>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>

            <!-- Modal Title -->
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Konfirmasi Tambah Foto</h3>

            <!-- Modal Content -->
            <div class="text-left bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-200">
                <p class="text-gray-700 mb-4 font-semibold">Anda akan menambahkan foto galeri dengan data:</p>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Judul:</span>
                        <span class="font-semibold text-gray-800" id="confirmTitle">-</span>
                    </div>
                    <div class="py-2 border-b border-gray-200">
                        <span class="text-gray-600">Deskripsi:</span>
                        <p class="text-gray-800 text-sm mt-1" id="confirmDescription">-</p>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">File:</span>
                        <span class="font-semibold text-gray-800" id="confirmFileName">-</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-600">Ukuran:</span>
                        <span class="font-semibold text-gray-800" id="confirmFileSize">-</span>
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
                            <p class="text-blue-700 text-sm mt-1">Foto akan ditambahkan ke galeri dan dapat dilihat oleh pengunjung website.</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-gray-600 mb-8 text-lg">Apakah Anda yakin ingin menambahkan foto ini?</p>

            <!-- Modal Actions -->
            <div class="flex gap-4">
                <button id="cancelBtn"
                        class="flex-1 bg-gray-100 text-gray-700 px-6 py-4 rounded-xl hover:bg-gray-200 transition-all duration-300 font-semibold border border-gray-200 hover:border-gray-300 transform hover:scale-105">
                    Batal
                </button>
                <button id="confirmBtn"
                        class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-semibold shadow-xl transform hover:scale-105">
                    Ya, Tambahkan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
// Global variables for modal
let confirmModal, modalContent, submitBtn, cancelBtn, confirmBtn, galleryForm;

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
    const input = document.getElementById('image');
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
    const imageFile = document.getElementById('image').files[0];

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

    if (!imageFile) {
        alert('Foto harus dipilih!');
        document.getElementById('image').click();
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
    galleryForm = document.getElementById('galleryForm');

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
        const imageFile = document.getElementById('image').files[0];
        const previewImage = document.getElementById('preview-image');

        // Update modal content
        document.getElementById('confirmTitle').textContent = titleValue;
        document.getElementById('confirmDescription').textContent = descriptionValue;
        document.getElementById('confirmFileName').textContent = imageFile.name;
        document.getElementById('confirmFileSize').textContent = formatFileSize(imageFile.size);
        document.getElementById('confirmPreview').src = previewImage.src;

        showConfirmModal();
    });

    // Cancel button
    cancelBtn.addEventListener('click', hideConfirmModal);

    // Confirm button
    confirmBtn.addEventListener('click', function() {
        // Show loading state
        confirmBtn.disabled = true;
        confirmBtn.innerHTML = '<span>Menyimpan...</span>';

        // Submit form
        galleryForm.submit();
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
