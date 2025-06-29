@extends('layouts.admin')

@section('page-title', 'Edit Petugas - ' . $user->name)

@section('main-content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 py-8">
    <div class="max-w-5xl mx-auto px-4">
        <!-- Header Section -->
        <div class="mb-10 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl shadow-lg mb-6 transform hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-3">
                Edit Petugas
            </h1>
            <p class="text-gray-600 text-lg">Perbarui informasi petugas {{ $user->name }}</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white shadow-2xl rounded-3xl border border-gray-200 overflow-hidden transform hover:scale-[1.01] transition-all duration-500">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-700 px-8 py-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">Informasi Petugas</h3>
                        <p class="text-blue-100 text-sm">Lengkapi formulir di bawah untuk memperbarui data petugas</p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8 bg-white">
                <form id="editPetugasForm" action="{{ route('admin.petugas.update', $user) }}" method="POST" class="space-y-10">
                    @csrf
                    @method('PUT')

                    <!-- Personal Information Section -->
                    <div class="space-y-8">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-2 h-8 bg-gradient-to-b from-blue-500 to-purple-600 rounded-full"></div>
                            <h4 class="text-xl font-semibold text-gray-800">Informasi Personal</h4>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Name Field -->
                            <div class="group">
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-4">
                                    <span class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span>Nama Lengkap</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="text" id="name" name="name" required
                                           class="w-full px-6 py-4 pl-14 bg-gray-50 border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400 hover:bg-gray-100 group-hover:border-gray-300"
                                           value="{{ old('name', $user->name) }}"
                                           placeholder="Masukkan nama lengkap">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('name')
                                    <div class="flex items-center space-x-2 mt-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="group">
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-4">
                                    <span class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                        <span>Alamat Email</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="email" id="email" name="email" required
                                           class="w-full px-6 py-4 pl-14 bg-gray-50 border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400 hover:bg-gray-100 group-hover:border-gray-300"
                                           value="{{ old('email', $user->email) }}"
                                           placeholder="contoh@email.com">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('email')
                                    <div class="flex items-center space-x-2 mt-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Security Section -->
                    <div class="space-y-8">
                        <div class="flex items-center justify-center my-10">
                            <div class="flex-grow h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                            <div class="mx-6 bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-full text-sm font-semibold shadow-lg">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <span>Keamanan Account</span>
                                </div>
                            </div>
                            <div class="flex-grow h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Password Field -->
                            <div class="group">
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-4">
                                    <span class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        <span>Password Baru</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="password" id="password" name="password"
                                           class="w-full px-6 py-4 pl-14 bg-gray-50 border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400 hover:bg-gray-100 group-hover:border-gray-300"
                                           placeholder="Kosongkan jika tidak ingin mengubah">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-gray-500 text-sm mt-3 flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Biarkan kosong jika tidak ingin mengubah password</span>
                                </p>
                                @error('password')
                                    <div class="flex items-center space-x-2 mt-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Confirmation Field -->
                            <div class="group">
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-4">
                                    <span class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Konfirmasi Password</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="w-full px-6 py-4 pl-14 bg-gray-50 border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400 hover:bg-gray-100 group-hover:border-gray-300"
                                           placeholder="Ulangi password baru">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-gray-500 text-sm mt-3 flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Pastikan password sama dengan yang di atas</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-10">
                        <button type="button" id="submitBtn"
                                class="group flex-1 relative bg-gradient-to-r from-blue-600 to-purple-700 text-white px-8 py-5 rounded-2xl hover:from-blue-700 hover:to-purple-800 transition-all duration-300 font-bold text-lg shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="relative flex items-center justify-center space-x-3">
                                <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                <span>Update Petugas</span>
                            </span>
                        </button>
                        <a href="{{ route('admin.petugas') }}"
                           class="group flex-1 relative bg-gray-100 text-gray-700 px-8 py-5 rounded-2xl hover:bg-gray-200 transition-all duration-300 font-bold text-lg border-2 border-gray-200 hover:border-gray-300 flex items-center justify-center space-x-3 transform hover:scale-105">
                            <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>Kembali</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Card -->
        <div class="mt-10 bg-blue-50 border border-blue-200 rounded-2xl p-8 shadow-xl">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-xl font-bold text-blue-900 mb-4">Informasi Penting</h4>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 text-blue-800">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span>Email harus unik dan belum terdaftar di sistem</span>
                        </div>
                        <div class="flex items-center space-x-3 text-blue-800">
                            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                            <span>Password minimal 8 karakter jika ingin diubah</span>
                        </div>
                        <div class="flex items-center space-x-3 text-blue-800">
                            <div class="w-2 h-2 bg-cyan-500 rounded-full"></div>
                            <span>Pastikan informasi yang dimasukkan sudah benar sebelum menyimpan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
    <div class="relative p-8 border w-full max-w-md mx-4 shadow-2xl rounded-3xl bg-white border-gray-200 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="text-center">
            <!-- Modal Icon -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 mb-6 shadow-xl">
                <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>

            <!-- Modal Title -->
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Konfirmasi Perubahan Data</h3>

            <!-- Modal Content -->
            <div class="text-left bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-200">
                <p class="text-gray-700 mb-4 font-semibold">Anda akan mengubah data petugas dengan informasi:</p>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Nama:</span>
                        <span class="font-semibold text-gray-800" id="confirmName">-</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Email:</span>
                        <span class="font-semibold text-gray-800" id="confirmEmail">-</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-600">Password:</span>
                        <span class="font-semibold text-gray-800" id="confirmPassword">Tidak diubah</span>
                    </div>
                </div>
            </div>

            <p class="text-gray-600 mb-8 text-lg">Apakah Anda yakin ingin menyimpan perubahan ini?</p>

            <!-- Modal Actions -->
            <div class="flex gap-4">
                <button id="cancelBtn"
                        class="flex-1 bg-gray-100 text-gray-700 px-6 py-4 rounded-xl hover:bg-gray-200 transition-all duration-300 font-semibold border border-gray-200 hover:border-gray-300 transform hover:scale-105">
                    Batal
                </button>
                <button id="confirmBtn"
                        class="flex-1 bg-gradient-to-r from-blue-600 to-purple-700 text-white px-6 py-4 rounded-xl hover:from-blue-700 hover:to-purple-800 transition-all duration-300 font-semibold shadow-xl transform hover:scale-105">
                    Ya, Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editPetugasForm');
    const modal = document.getElementById('confirmationModal');
    const modalContent = document.getElementById('modalContent');
    const submitBtn = document.getElementById('submitBtn');
    const confirmBtn = document.getElementById('confirmBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    const confirmName = document.getElementById('confirmName');
    const confirmEmail = document.getElementById('confirmEmail');
    const confirmPassword = document.getElementById('confirmPassword');

    // Show confirmation modal with animation
    submitBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Validate form first
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        // Update confirmation details
        confirmName.textContent = nameInput.value;
        confirmEmail.textContent = emailInput.value;
        confirmPassword.textContent = passwordInput.value ? 'Akan diubah' : 'Tidak diubah';

        // Show modal with animation
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Animate modal appearance
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    });

    // Hide modal with animation
    function hideModal() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 300);
    }

    // Cancel button
    cancelBtn.addEventListener('click', hideModal);

    // Confirm button - submit form
    confirmBtn.addEventListener('click', function() {
        hideModal();
        form.submit();
    });

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            hideModal();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            hideModal();
        }
    });

    // Add floating label effect
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });

        // Check if input has value on load
        if (input.value) {
            input.parentElement.classList.add('focused');
        }
    });

    // Add ripple effect to buttons
    function createRipple(event) {
        const button = event.currentTarget;
        const circle = document.createElement("span");
        const diameter = Math.max(button.clientWidth, button.clientHeight);
        const radius = diameter / 2;

        circle.style.width = circle.style.height = `${diameter}px`;
        circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
        circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
        circle.classList.add("ripple");

        const ripple = button.getElementsByClassName("ripple")[0];
        if (ripple) {
            ripple.remove();
        }

        button.appendChild(circle);
    }

    const buttons = document.querySelectorAll("button");
    buttons.forEach(button => {
        button.addEventListener("click", createRipple);
    });
});

// Add CSS for ripple effect
const style = document.createElement('style');
style.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(59, 130, 246, 0.3);
        transform: scale(0);
        animation: ripple 600ms linear;
        pointer-events: none;
    }

    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .focused {
        transform: translateY(-2px);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #3b82f6, #8b5cf6);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #2563eb, #7c3aed);
    }

    /* Smooth transitions for all elements */
    * {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
`;
document.head.appendChild(style);
</script>
@endsection
