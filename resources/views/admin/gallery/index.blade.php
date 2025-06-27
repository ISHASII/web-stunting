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
                        <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}"
                             class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>

                        <!-- Date Badge -->
                        <div class="absolute top-3 right-3 bg-blue-600 text-white px-2 py-1 rounded-lg text-xs font-medium">
                            {{ $gallery->created_at->format('d/m/Y') }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <h4 class="text-lg font-bold text-blue-900 mb-2 line-clamp-2">{{ $gallery->title }}</h4>
                        <p class="text-blue-600 text-sm mb-4 line-clamp-3">{{ Str::limit($gallery->description, 100) }}</p>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <a href="{{ route('admin.gallery.edit', $gallery) }}"
                               class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition duration-300 text-center">
                                Edit
                            </a>
                            <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus foto ini?')"
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
@endsection
