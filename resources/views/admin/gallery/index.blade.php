@extends('layouts.admin')

@section('page-title', 'Kelola Galeri')

@section('main-content')
<div class="mb-6">
    <a href="{{ route('admin.gallery.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
        Tambah Foto Baru
    </a>
</div>

<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">
            Galeri Kegiatan ({{ $galleries->total() }} total)
        </h3>
    </div>

    @if($galleries->count() > 0)
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($galleries as $gallery)
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}"
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $gallery->title }}</h4>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($gallery->description, 100) }}</p>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.gallery.edit', $gallery) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                Edit
                            </a>
                            <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus foto ini?')"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-gray-50 text-xs text-gray-500">
                        Ditambahkan: {{ $gallery->created_at->format('d/m/Y') }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $galleries->links() }}
        </div>
    @else
        <div class="px-6 py-12 text-center">
            <p class="text-gray-500">Belum ada foto dalam galeri</p>
        </div>
    @endif
</div>
@endsection
