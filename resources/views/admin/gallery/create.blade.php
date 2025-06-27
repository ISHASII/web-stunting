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
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data"
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
                        <button type="submit"
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

<!-- JavaScript -->
<script>
function handleFileSelect(input) {
    const file = input.files[0];
    const uploadArea = document.getElementById('upload-area');
    const previewArea = document.getElementById('preview-area');
    const previewImage = document.getElementById('preview-image');
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');

    if (file) {
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

// Drag and Drop
document.addEventListener('DOMContentLoaded', () => {
    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('image');

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
});
</script>
@endsection
