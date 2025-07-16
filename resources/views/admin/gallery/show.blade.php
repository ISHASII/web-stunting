@extends('layouts.admin')

@section('page-title', 'Detail Galeri - ' . $gallery->title)

@section('main-content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="space-y-6 p-4 sm:p-6">
        <!-- Header Section -->
        <div class="flex flex-col space-y-4 lg:flex-row lg:items-center lg:justify-between lg:space-y-0">
            <div>
                <div class="flex items-center gap-3 sm:gap-4">
                    <a href="{{ route('admin.gallery.index') }}"
                       class="p-2 sm:p-3 rounded-xl bg-white text-gray-600 hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Detail Galeri
                        </h1>
                        <p class="text-gray-600 mt-1 sm:mt-2 text-sm sm:text-base lg:text-lg">
                            Lihat detail foto dan informasi lengkap
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                <a href="{{ route('admin.gallery.edit', $gallery) }}"
                   class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl shadow-lg text-xs sm:text-sm font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span class="hidden sm:inline">Edit Galeri</span>
                    <span class="sm:hidden">Edit</span>
                </a>

                <button onclick="confirmDelete('{{ $gallery->id }}', '{{ addslashes($gallery->title) }}', '{{ Storage::url($gallery->image) }}')"
                        class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-xl shadow-lg text-xs sm:text-sm font-semibold hover:from-red-700 hover:to-red-800 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <span class="hidden sm:inline">Hapus Galeri</span>
                    <span class="sm:hidden">Hapus</span>
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Image Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <!-- Image Container -->
                    <div class="relative group">
                        <img src="{{ Storage::url($gallery->image) }}"
                             alt="{{ $gallery->title }}"
                             class="w-full h-64 sm:h-96 lg:h-[500px] object-cover">

                        <!-- Overlay with zoom button -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                            <button onclick="openImageModal()"
                                    class="bg-white bg-opacity-90 p-3 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-opacity-100 hover:scale-110">
                                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Image Info -->
                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">{{ $gallery->title }}</h2>
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Diunggah pada {{ $gallery->created_at->format('d F Y') }}</span>
                                </div>
                            </div>

                            <!-- Download Button -->
                            <a href="{{ Storage::url($gallery->image) }}"
                               download="{{ $gallery->title }}"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-300 text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Panel -->
            <div class="space-y-6">
                <!-- Description Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Deskripsi</h3>
                    </div>
                    <div class="prose prose-sm max-w-none">
                        <p class="text-gray-700 leading-relaxed">{{ $gallery->description }}</p>
                    </div>
                </div>

                <!-- Details Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Detail Foto</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Tanggal Upload:</span>
                            <span class="font-medium text-gray-900">{{ $gallery->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Terakhir Diubah:</span>
                            <span class="font-medium text-gray-900">{{ $gallery->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Status:</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                    </div>
                    <div class="space-y-3">
                        <button onclick="copyImageUrl()"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            Salin URL Gambar
                        </button>
                        <button onclick="shareImage()"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                            Bagikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-7xl max-h-full">
        <button onclick="closeImageModal()"
                class="absolute top-4 right-4 text-white hover:text-gray-300 z-60">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <img src="{{ Storage::url($gallery->image) }}"
             alt="{{ $gallery->title }}"
             class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full mx-4 transform transition-all duration-300">
        <div class="p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Hapus Galeri</h3>
                    <p class="text-sm text-gray-500">Aksi ini tidak dapat dibatalkan</p>
                </div>
            </div>

            <div class="mb-6">
                <p class="text-gray-700 mb-4">Apakah Anda yakin ingin menghapus galeri ini?</p>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <img id="deletePreviewImage" src="" alt="" class="w-16 h-16 object-cover rounded-lg">
                        <div>
                            <p class="font-medium text-gray-900" id="deleteTitle"></p>
                            <p class="text-sm text-gray-500">Foto galeri akan dihapus permanen</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <button onclick="hideDeleteModal()"
                        class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openImageModal() {
    document.getElementById('imageModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function copyImageUrl() {
    const imageUrl = "{{ Storage::url($gallery->image) }}";
    const fullUrl = window.location.origin + imageUrl;

    navigator.clipboard.writeText(fullUrl).then(function() {
        // Show success notification
        showNotification('URL gambar berhasil disalin!', 'success');
    }).catch(function() {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = fullUrl;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        showNotification('URL gambar berhasil disalin!', 'success');
    });
}

function shareImage() {
    const imageUrl = window.location.origin + "{{ Storage::url($gallery->image) }}";
    const title = "{{ $gallery->title }}";

    if (navigator.share) {
        navigator.share({
            title: title,
            text: "{{ $gallery->description }}",
            url: imageUrl
        });
    } else {
        // Fallback - copy URL
        copyImageUrl();
    }
}

function confirmDelete(id, title, imageUrl) {
    document.getElementById('deleteTitle').textContent = title;
    document.getElementById('deletePreviewImage').src = imageUrl;
    document.getElementById('deleteForm').action = `/admin/gallery/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function hideDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white transition-all duration-300 ${
        type === 'success' ? 'bg-green-500' : 'bg-blue-500'
    }`;
    notification.textContent = message;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.classList.add('opacity-0');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Close modal when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideDeleteModal();
    }
});

// ESC key handler
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
        hideDeleteModal();
    }
});
</script>
@endsection
