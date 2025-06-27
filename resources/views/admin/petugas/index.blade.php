@extends('layouts.admin')

@section('page-title', 'Kelola Petugas')

@section('main-content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-blue-100 p-6">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-blue-900 mb-2">Kelola Petugas</h1>
        <p class="text-blue-600">Kelola data petugas kesehatan sistem monitoring stunting</p>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Add New Petugas Button -->
    <div class="mb-6">
        <a href="{{ route('admin.petugas.create') }}"
           class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 inline-flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span>Tambah Petugas Baru</span>
        </a>
    </div>

    <!-- Petugas Table -->
    <div class="bg-white/80 backdrop-blur-sm border border-blue-100 shadow-xl rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
            <h3 class="text-xl font-semibold text-white">
                Daftar Petugas ({{ $petugas->total() }} total)
            </h3>
        </div>

        @if($petugas->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pengukuran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bergabung</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($petugas as $user)
                        <tr class="hover:bg-blue-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ substr($user->name, 0, 2) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->measurements_count ?? 0 }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->created_at->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('admin.petugas.edit', $user) }}"
                                   class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 px-3 py-1 rounded-lg transition-colors duration-200">Edit</a>
                                <form method="POST" action="{{ route('admin.petugas.destroy', $user) }}" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 px-3 py-1 rounded-lg transition-colors duration-200">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $petugas->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <p class="text-gray-500 text-lg">Belum ada petugas terdaftar</p>
                <p class="text-gray-400 text-sm mt-2">Klik tombol "Tambah Petugas Baru" untuk menambah petugas</p>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach((form) => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const row = form.closest('tr');
            const userName = row.querySelector('.text-sm.font-medium').textContent.trim();
            const measurementCount = row.querySelector('td:nth-child(3) .text-sm').textContent.trim();

            let confirmMessage = `Yakin ingin menghapus petugas ${userName}?\n\nData petugas akan dihapus secara permanen.`;

            // Add warning if petugas has measurements
            if (parseInt(measurementCount) > 0) {
                confirmMessage = `Yakin ingin menghapus petugas ${userName}?\n\nPeringatan: Petugas ini memiliki ${measurementCount} data pengukuran.\nSemua data terkait akan ikut terhapus secara permanen.\n\nApakah Anda yakin ingin melanjutkan?`;
            }

            if (confirm(confirmMessage)) {
                form.submit();
            }
        });
    });
});
</script>
@endsection
