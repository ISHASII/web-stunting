@extends('layouts.admin')

@section('page-title', 'Edit Foto Galeri')

@section('main-content')
<div class="max-w-2xl">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Form Edit Foto</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                    <input type="text" id="title" name="title" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           value="{{ old('title', $gallery->title) }}">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $gallery->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                    @if($gallery->image)
                        <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}"
                             class="w-48 h-32 object-cover rounded-md mb-3">
                    @endif

                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Baru (Opsional)</label>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto. Format: JPG, JPEG, PNG. Maksimal 2MB</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                        Update Foto
                    </button>
                    <a href="{{ route('admin.gallery.index') }}"
                       class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-400 transition duration-300">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
