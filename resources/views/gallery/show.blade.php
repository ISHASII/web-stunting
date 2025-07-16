@extends('layouts.public')

@section('title', $gallery->title . ' - Galeri')

@section('content')
<!-- Header Section -->
<section class="relative bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm text-gray-500">
                    <li><a href="{{ route('home') }}" class="hover:text-green-600 transition-colors">Beranda</a></li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <span class="text-gray-900 font-medium">{{ Str::limit($gallery->title, 30) }}</span>
                    </li>
                </ol>
            </nav>

            <!-- Title and Meta -->
            <div class="text-center">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-700 font-medium mb-4 text-sm">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $gallery->created_at->format('d F Y') }}
                </div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">
                    {{ $gallery->title }}
                </h1>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm">
                    {{ $gallery->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Detail Content -->
<section class="py-8 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <!-- Image Section -->
            <div class="relative">
                <img src="{{ Storage::url($gallery->image) }}"
                     alt="{{ $gallery->title }}"
                     class="w-full h-64 lg:h-72 object-cover cursor-pointer hover:opacity-95 transition-opacity duration-200"
                     onclick="openImageModal()">

                <!-- Image Actions -->
                <div class="absolute top-3 right-3 flex space-x-2">
                    <button onclick="shareGallery()"
                            class="p-2 bg-white/90 backdrop-blur-sm rounded-lg text-gray-700 hover:bg-white hover:text-green-600 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-6">
                <!-- Description -->
                <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($gallery->description)) !!}
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3 mt-6 pt-4 border-t border-gray-100">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors duration-200 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black/80 z-50 hidden" style="display: none;">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative max-w-5xl max-h-[90vh] w-full">
            <button onclick="closeImageModal()"
                    class="absolute top-4 right-4 z-10 p-2 bg-white/10 backdrop-blur-sm rounded-full text-white hover:bg-white/20 transition-all duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img src="{{ Storage::url($gallery->image) }}"
                 alt="{{ $gallery->title }}"
                 class="max-w-full max-h-full object-contain rounded-lg shadow-2xl mx-auto">
        </div>
    </div>
</div>

<script>
function shareGallery() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $gallery->title }}',
            text: '{{ Str::limit($gallery->description, 100) }}',
            url: window.location.href
        });
    } else {
        // Fallback: copy URL to clipboard
        navigator.clipboard.writeText(window.location.href).then(() => {
            // Show simple notification
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
            notification.textContent = 'URL berhasil disalin!';
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 2000);
        });
    }
}
</script>
@endsection
