@extends('layouts.admin')

@section('page-title', 'Edit Data Anak - ' . $child->name)

@section('main-content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="space-y-4 sm:space-y-6 lg:space-y-8 p-3 sm:p-6">
        <div class="max-w-6xl mx-auto space-y-4 sm:space-y-6 lg:space-y-8">
            <!-- Header Section -->
            <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg border border-blue-100 p-4 sm:p-6">
                <div class="flex flex-col space-y-4 md:flex-row md:items-center md:justify-between md:space-y-0">
                    <div class="flex items-center gap-3 sm:gap-4 lg:gap-6">
                        <a href="{{ route('admin.children.show', $child) }}"
                           class="p-2 sm:p-3 rounded-lg sm:rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                Edit Data Anak
                            </h1>
                            <p class="text-gray-600 mt-1 sm:mt-2 text-sm sm:text-base lg:text-lg">
                                Ubah informasi data anak
                                <span class="font-semibold text-blue-600 block sm:inline">{{ $child->name }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Child Avatar -->
                    <div class="flex items-center gap-3 sm:gap-4 md:justify-end">
                        @if($child->photo)
                            <img src="{{ Storage::url($child->photo) }}" alt="{{ $child->name }}"
                                 class="w-12 h-12 sm:w-16 sm:h-16 object-cover rounded-full ring-2 sm:ring-4 ring-blue-200 shadow-lg">
                        @else
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center ring-2 sm:ring-4 ring-blue-200 shadow-lg">
                                <span class="text-white text-lg sm:text-xl font-bold">{{ substr($child->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="text-left sm:text-right">
                            <div class="text-xs sm:text-sm text-gray-500">Status</div>
                            <div class="text-blue-600 font-semibold text-sm sm:text-base">{{ $child->latest_measurement ? $child->latest_measurement->status : 'Belum Diukur' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-xl sm:rounded-2xl p-3 sm:p-4 shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500 mr-2 sm:mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-green-700 font-medium text-sm sm:text-base">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 rounded-xl sm:rounded-2xl p-3 sm:p-4 shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500 mr-2 sm:mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-red-700 font-medium text-sm sm:text-base">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Form Card -->
            <div class="bg-white rounded-xl sm:rounded-2xl shadow-xl border border-blue-100 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
                    <div class="flex items-center">
                        <div class="p-2 sm:p-3 bg-white/20 rounded-lg sm:rounded-xl mr-3 sm:mr-4">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white">Form Edit Data Anak</h3>
                            <p class="text-blue-100 mt-1 text-sm sm:text-base">Lengkapi semua informasi yang diperlukan</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-4 sm:p-6 lg:p-8">
                    <form id="editForm" action="{{ route('admin.children.update', $child) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid lg:grid-cols-3 gap-6 sm:gap-8">
                            <!-- Left Column - Photo -->
                            <div class="lg:col-span-1">
                                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-blue-100">
                                    <h4 class="text-base sm:text-lg font-semibold text-gray-800 mb-3 sm:mb-4 flex items-center">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Foto Anak
                                    </h4>

                                    <div class="text-center">
                                        @if($child->photo)
                                            <div class="mb-4 sm:mb-6">
                                                <img src="{{ Storage::url($child->photo) }}" alt="{{ $child->name }}"
                                                     class="w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-xl sm:rounded-2xl shadow-lg mx-auto ring-2 sm:ring-4 ring-blue-200">
                                                <p class="text-xs sm:text-sm text-gray-600 mt-2 font-medium">Foto saat ini</p>
                                            </div>
                                        @else
                                            <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl sm:rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 ring-2 sm:ring-4 ring-blue-200 shadow-lg">
                                                <span class="text-white text-2xl sm:text-4xl font-bold">{{ substr($child->name, 0, 1) }}</span>
                                            </div>
                                        @endif

                                        <div class="relative">
                                            <input type="file" name="photo" id="photo" accept="image/*"
                                                   class="block w-full text-xs sm:text-sm text-gray-600 file:mr-2 sm:file:mr-4 file:py-2 sm:file:py-3 file:px-3 sm:file:px-4 file:rounded-lg sm:file:rounded-xl file:border-0 file:text-xs sm:file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all duration-300">
                                            <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                                        </div>
                                        @error('photo')
                                            <p class="text-red-500 text-xs sm:text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Current Info -->
                                    <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-blue-200">
                                        <h5 class="font-semibold text-gray-800 mb-2 sm:mb-3 text-sm sm:text-base">Informasi Saat Ini</h5>
                                        <div class="space-y-2 text-xs sm:text-sm">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Umur:</span>
                                                <span class="font-medium text-blue-600">{{ floor($child->age_in_months) }} bulan</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Terdaftar:</span>
                                                <span class="font-medium">{{ $child->created_at->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Total Pengukuran:</span>
                                                <span class="font-medium text-green-600">{{ $child->measurements->count() }} kali</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Form Fields -->
                            <div class="lg:col-span-2">
                                <div class="space-y-4 sm:space-y-6">
                                    <!-- Name - Full width -->
                                    <div>
                                        <label for="name" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 sm:mb-3">
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                Nama Lengkap *
                                            </span>
                                        </label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $child->name) }}" required
                                               class="block w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white text-sm sm:text-base">
                                        @error('name')
                                            <p class="text-red-500 text-xs sm:text-sm mt-1 sm:mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- NIK - Full width -->
                                    <div>
                                        <label for="nik" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 sm:mb-3">
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                                </svg>
                                                NIK *
                                            </span>
                                        </label>
                                        <input type="text" name="nik" id="nik" value="{{ old('nik', $child->nik) }}" required maxlength="16"
                                               class="block w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white text-sm sm:text-base">
                                        @error('nik')
                                            <p class="text-red-500 text-xs sm:text-sm mt-1 sm:mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Gender and Birth Date - Side by side on larger screens -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                        <!-- Gender -->
                                        <div>
                                            <label for="gender" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 sm:mb-3">
                                                <span class="flex items-center">
                                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                                    </svg>
                                                    Jenis Kelamin *
                                                </span>
                                            </label>
                                            <select name="gender" id="gender" required
                                                    class="block w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white text-sm sm:text-base">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L" {{ old('gender', $child->gender) == 'L' ? 'selected' : '' }}>👦 Laki-laki</option>
                                                <option value="P" {{ old('gender', $child->gender) == 'P' ? 'selected' : '' }}>👧 Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <p class="text-red-500 text-xs sm:text-sm mt-1 sm:mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Birth Date -->
                                        <div>
                                            <label for="birth_date" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 sm:mb-3">
                                                <span class="flex items-center">
                                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    Tanggal Lahir *
                                                </span>
                                            </label>
                                            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $child->birth_date->format('Y-m-d')) }}" required
                                                   class="block w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white text-sm sm:text-base">
                                            @error('birth_date')
                                                <p class="text-red-500 text-xs sm:text-sm mt-1 sm:mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="flex flex-col-reverse sm:flex-row items-center gap-3 sm:gap-4 mt-8 sm:mt-10 pt-6 sm:pt-8 border-t border-gray-200">
                                        <a href="{{ route('admin.children.show', $child) }}"
                                           class="w-full sm:w-auto px-6 sm:px-8 py-2 sm:py-3 border-2 border-gray-300 rounded-lg sm:rounded-xl text-gray-700 hover:bg-gray-50 transition-all duration-300 font-medium shadow-sm hover:shadow-md text-center text-sm sm:text-base">
                                            <span class="flex items-center justify-center">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Batal
                                            </span>
                                        </a>
                                        <button type="submit"
                                                class="w-full sm:w-auto px-6 sm:px-8 py-2 sm:py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg sm:rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-sm sm:text-base">
                                            <span class="flex items-center justify-center">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Simpan Perubahan
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center hidden p-4">
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-2xl max-w-sm sm:max-w-md w-full transform transition-all duration-300 scale-95">
        <div class="p-4 sm:p-6">
            <div class="flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 mx-auto bg-blue-100 rounded-full mb-3 sm:mb-4">
                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <h3 class="text-lg sm:text-xl font-bold text-gray-900 text-center mb-2">Konfirmasi Perubahan</h3>
            <p class="text-gray-600 text-center mb-4 sm:mb-6 text-sm sm:text-base">Apakah Anda yakin ingin menyimpan perubahan data anak <span class="font-semibold text-blue-600">{{ $child->name }}</span>?</p>

            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                <button id="cancelBtn" type="button"
                        class="flex-1 px-3 sm:px-4 py-2 border border-gray-300 rounded-lg sm:rounded-xl text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm sm:text-base order-2 sm:order-1">
                    Batal
                </button>
                <button id="confirmBtn" type="button"
                        class="flex-1 px-3 sm:px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg sm:rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-medium text-sm sm:text-base order-1 sm:order-2">
                    Ya, Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editForm');
    const modal = document.getElementById('confirmModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const confirmBtn = document.getElementById('confirmBtn');

    // Prevent default form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Show modal with animation
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.querySelector('.bg-white').classList.remove('scale-95');
            modal.querySelector('.bg-white').classList.add('scale-100');
        }, 10);
    });

    // Cancel button
    cancelBtn.addEventListener('click', function() {
        hideModal();
    });

    // Confirm button
    confirmBtn.addEventListener('click', function() {
        hideModal();
        // Submit form after hiding modal
        setTimeout(() => {
            form.submit();
        }, 300);
    });

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            hideModal();
        }
    });

    function hideModal() {
        modal.querySelector('.bg-white').classList.remove('scale-100');
        modal.querySelector('.bg-white').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            hideModal();
        }
    });
});
</script>
@endsection
