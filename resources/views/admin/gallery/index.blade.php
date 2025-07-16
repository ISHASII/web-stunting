@extends('layouts.admin')

@section('page-title', 'Kelola Galeri')

@section('main-content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl p-6 m-5 shadow-lg">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white mb-2">Kelola Galeri</h1>
            <p class="text-blue-100 text-sm">Kelola foto dan dokumentasi kegiatan Anda</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}"
           class="bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Foto Baru
        </a>
    </div>
</div>

<!-- Stats Card -->
<div class="bg-white rounded-xl shadow-lg border border-blue-100 m-5 overflow-hidden">
    <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-blue-200">
        <div class="flex items-center gap-3">
            <div class="bg-blue-600 p-2 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-900">Galeri Kegiatan</h3>
                <p class="text-blue-600 text-sm">{{ $galleries->total() }} foto total</p>
            </div>
        </div>
    </div>

    @if($galleries->count() > 0)
        <!-- Gallery Grid -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($galleries as $gallery)
                <div class="group bg-white border border-blue-100 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden">
                        <a href="{{ route('admin.gallery.show', $gallery) }}" class="block">
                            <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}"
                                 class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>

                            <!-- View Icon Overlay -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                <div class="bg-white bg-opacity-90 p-3 rounded-full shadow-lg">
                                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>

                        <!-- Date Badge -->
                        <div class="absolute top-3 right-3 bg-blue-600 text-white px-2 py-1 rounded-lg text-xs font-medium">
                            {{ $gallery->created_at->format('d/m/Y') }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <a href="{{ route('admin.gallery.show', $gallery) }}" class="block hover:text-blue-700 transition duration-300">
                            <h4 class="text-lg font-bold text-blue-900 mb-2 line-clamp-2">{{ $gallery->title }}</h4>
                        </a>
                        <p class="text-blue-600 text-sm mb-4 line-clamp-3">{{ Str::limit($gallery->description, 100) }}</p>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <a href="{{ route('admin.gallery.show', $gallery) }}"
                               class="flex-1 bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition duration-300 text-center">
                                Lihat
                            </a>
                            <a href="{{ route('admin.gallery.edit', $gallery) }}"
                               class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition duration-300 text-center">
                                Edit
                            </a>
                            <form id="delete-form-{{ $gallery->id }}" action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        onclick="confirmDelete({{ $gallery->id }}, '{{ addslashes($gallery->title) }}', '{{ Storage::url($gallery->image) }}')"
                                        class="w-full bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-600 transition duration-300">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-blue-100 bg-blue-50/50">
            <div class="flex justify-center">
                {{ $galleries->links() }}
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="px-6 py-16 text-center">
            <div class="max-w-md mx-auto">
                <div class="bg-blue-100 rounded-full p-6 w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-blue-900 mb-2">Galeri Masih Kosong</h3>
                <p class="text-blue-600 mb-6">Belum ada foto dalam galeri. Mulai dengan menambahkan foto pertama Anda.</p>
                <a href="{{ route('admin.gallery.create') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Foto Pertama
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
    <div class="relative p-8 border w-full max-w-lg mx-4 shadow-2xl rounded-3xl bg-white border-gray-200 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="text-center">
            <!-- Modal Icon -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-r from-red-400 to-red-600 mb-6 shadow-xl">
                <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </div>

            <!-- Modal Title -->
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Konfirmasi Hapus Foto</h3>

            <!-- Modal Content -->
            <div class="text-left bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-200">
                <p class="text-gray-700 mb-4 font-semibold">Anda akan menghapus foto galeri:</p>

                <!-- Photo Preview -->
                <div class="mb-4 flex justify-center">
                    <img id="deleteImagePreview" class="w-32 h-24 object-cover rounded-lg shadow-md border-2 border-gray-200" src="" alt="Preview">
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Judul:</span>
                        <span class="font-semibold text-gray-800 text-right" id="deleteTitle">-</span>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.729-.833-2.5 0L4.232 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div>
                            <p class="text-red-800 font-semibold text-sm">Peringatan!</p>
                            <p class="text-red-700 text-sm mt-1">Foto yang dihapus tidak dapat dikembalikan. Pastikan Anda yakin dengan keputusan ini.</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-gray-600 mb-8 text-lg">Apakah Anda yakin ingin menghapus foto ini?</p>

            <!-- Modal Actions -->
            <div class="flex gap-4">
                <button id="cancelDeleteBtn"
                        class="flex-1 bg-gray-100 text-gray-700 px-6 py-4 rounded-xl hover:bg-gray-200 transition-all duration-300 font-semibold border border-gray-200 hover:border-gray-300 transform hover:scale-105">
                    Batal
                </button>
                <button id="confirmDeleteBtn"
                        class="flex-1 bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-4 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-300 font-semibold shadow-xl transform hover:scale-105">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
// Global variables for modal
let deleteModal, modalContent, cancelDeleteBtn, confirmDeleteBtn;
let currentDeleteForm = null;

// Show delete confirmation modal
function showDeleteModal() {
    deleteModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

// Hide delete confirmation modal
function hideDeleteModal() {
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        deleteModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentDeleteForm = null;
    }, 300);
}

// Confirm delete function
function confirmDelete(galleryId, title, imageSrc) {
    // Set the form to be submitted
    currentDeleteForm = document.getElementById('delete-form-' + galleryId);

    // Update modal content
    document.getElementById('deleteTitle').textContent = title;
    document.getElementById('deleteImagePreview').src = imageSrc;

    showDeleteModal();
}

// Initialize modal functionality
document.addEventListener('DOMContentLoaded', () => {
    // Initialize modal elements
    deleteModal = document.getElementById('deleteModal');
    modalContent = document.getElementById('modalContent');
    cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    // Cancel button
    cancelDeleteBtn.addEventListener('click', hideDeleteModal);

    // Confirm button
    confirmDeleteBtn.addEventListener('click', function() {
        if (currentDeleteForm) {
            // Show loading state
            confirmDeleteBtn.disabled = true;
            confirmDeleteBtn.innerHTML = '<span>Menghapus...</span>';

            // Submit the delete form
            currentDeleteForm.submit();
        }
    });

    // Close modal when clicking outside
    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            hideDeleteModal();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
            hideDeleteModal();
        }
    });
});
</script>
@endsection
