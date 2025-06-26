@extends('layouts.public')

@section('title', 'Beranda - Sistem Deteksi Stunting')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="1"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8 animate-fade-in-up">
                <div class="space-y-6">
                    <h1 class="text-5xl lg:text-7xl font-black leading-tight tracking-tight">
                        Sistem Deteksi
                        <span class="bg-gradient-to-r from-yellow-300 to-orange-400 bg-clip-text text-transparent">
                            Stunting
                        </span>
                    </h1>
                    <p class="text-xl lg:text-2xl text-blue-100 leading-relaxed max-w-2xl">
                        Deteksi dini stunting pada anak dengan teknologi terdepan.
                        Bersama-sama kita cegah stunting untuk masa depan Indonesia yang lebih sehat.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-6">
                    <a href="#about"
                       class="group border-2 border-white/30 backdrop-blur-sm hover:bg-white hover:text-blue-600 px-10 py-5 rounded-2xl font-bold text-lg transition-all duration-300 text-center hover:shadow-xl transform hover:-translate-y-1">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            <div class="hidden lg:block animate-fade-in-right">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-yellow-400/20 to-orange-500/20 rounded-3xl blur-2xl transform rotate-6"></div>
                    <img src="{{ asset('images/hero-stunting.jpg') }}"
                         alt="Anak Sehat"
                         class="relative rounded-3xl shadow-2xl transform hover:scale-105 transition-transform duration-500">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="group text-center p-8 rounded-3xl bg-white shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="relative">
                    <div class="text-5xl font-black text-blue-600 mb-4 group-hover:scale-110 transition-transform duration-300">1000+</div>
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-400 to-blue-600 mx-auto mb-4 rounded-full"></div>
                    <div class="text-gray-600 font-semibold text-lg">Anak Terdeteksi</div>
                </div>
            </div>
            <div class="group text-center p-8 rounded-3xl bg-white shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="relative">
                    <div class="text-5xl font-black text-green-600 mb-4 group-hover:scale-110 transition-transform duration-300">95%</div>
                    <div class="w-16 h-1 bg-gradient-to-r from-green-400 to-green-600 mx-auto mb-4 rounded-full"></div>
                    <div class="text-gray-600 font-semibold text-lg">Akurasi Deteksi</div>
                </div>
            </div>
            <div class="group text-center p-8 rounded-3xl bg-white shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="relative">
                    <div class="text-5xl font-black text-yellow-600 mb-4 group-hover:scale-110 transition-transform duration-300">50+</div>
                    <div class="w-16 h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 mx-auto mb-4 rounded-full"></div>
                    <div class="text-gray-600 font-semibold text-lg">Posyandu Terhubung</div>
                </div>
            </div>
            <div class="group text-center p-8 rounded-3xl bg-white shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="relative">
                    <div class="text-5xl font-black text-red-600 mb-4 group-hover:scale-110 transition-transform duration-300">24/7</div>
                    <div class="w-16 h-1 bg-gradient-to-r from-red-400 to-red-600 mx-auto mb-4 rounded-full"></div>
                    <div class="text-gray-600 font-semibold text-lg">Layanan Online</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Stunting Section -->
<section id="about" class="py-24 bg-gradient-to-br from-gray-50 via-blue-50/50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <div class="inline-flex items-center px-6 py-3 rounded-full bg-blue-100 text-blue-800 font-semibold mb-6">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                Tentang Stunting
            </div>
            <h2 class="text-5xl lg:text-6xl font-black text-gray-900 mb-8 leading-tight">
                Apa itu <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Stunting?</span>
            </h2>
            <p class="text-xl lg:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                Stunting adalah kondisi gagal tumbuh pada anak akibat kekurangan gizi kronis
                yang terjadi dalam 1000 hari pertama kehidupan.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <h3 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-10">
                    Mengapa Deteksi Dini Penting?
                </h3>
                <div class="space-y-8">
                    <div class="group flex items-start p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mr-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Intervensi Dini</h4>
                            <p class="text-gray-600 leading-relaxed">Penanganan lebih efektif jika dilakukan sejak dini untuk mencegah komplikasi jangka panjang</p>
                        </div>
                    </div>

                    <div class="group flex items-start p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mr-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Mencegah Dampak Jangka Panjang</h4>
                            <p class="text-gray-600 leading-relaxed">Stunting dapat mempengaruhi perkembangan kognitif dan fisik anak hingga dewasa</p>
                        </div>
                    </div>

                    <div class="group flex items-start p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center mr-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Meningkatkan Kualitas Hidup</h4>
                            <p class="text-gray-600 leading-relaxed">Anak dapat tumbuh dan berkembang optimal sesuai dengan potensinya</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-indigo-500/20 rounded-3xl blur-2xl transform -rotate-6"></div>
                <img src="{{ asset('images/stunting-info.jpg') }}"
                     alt="Informasi Stunting"
                     class="relative rounded-3xl shadow-2xl hover:scale-105 transition-transform duration-500">
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-24 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <div class="inline-flex items-center px-6 py-3 rounded-full bg-indigo-100 text-indigo-800 font-semibold mb-6">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                </svg>
                Cara Kerja
            </div>
            <h2 class="text-5xl lg:text-6xl font-black text-gray-900 mb-8 leading-tight">
                Cara Kerja <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Sistem</span>
            </h2>
            <p class="text-xl lg:text-2xl text-gray-600 max-w-3xl mx-auto">
                Sistem deteksi stunting yang mudah, cepat, dan akurat
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="group text-center relative">
                <div class="relative mb-8">
                    <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-blue-600 rounded-3xl flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                        <span class="text-3xl font-black text-white">1</span>
                    </div>
                    <!-- Connection Line -->
                    <div class="hidden md:block absolute top-12 left-full w-full h-0.5 bg-gradient-to-r from-blue-300 to-transparent"></div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Input Data Anak</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Masukkan data anak seperti nama, tanggal lahir, jenis kelamin, dan tinggi badan dengan mudah dan aman
                    </p>
                </div>
            </div>

            <div class="group text-center relative">
                <div class="relative mb-8">
                    <div class="w-24 h-24 bg-gradient-to-r from-green-500 to-green-600 rounded-3xl flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                        <span class="text-3xl font-black text-white">2</span>
                    </div>
                    <!-- Connection Line -->
                    <div class="hidden md:block absolute top-12 left-full w-full h-0.5 bg-gradient-to-r from-green-300 to-transparent"></div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Analisis Otomatis</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sistem menghitung Z-Score berdasarkan standar WHO dan menganalisis status gizi secara real-time
                    </p>
                </div>
            </div>

            <div class="group text-center">
                <div class="relative mb-8">
                    <div class="w-24 h-24 bg-gradient-to-r from-purple-500 to-purple-600 rounded-3xl flex items-center justify-center mx-auto shadow-xl group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-110">
                        <span class="text-3xl font-black text-white">3</span>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Hasil & Rekomendasi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dapatkan hasil deteksi komprehensif dan rekomendasi tindak lanjut dari tenaga kesehatan profesional
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@if($galleries && $galleries->count() > 0)
<!-- Gallery Section -->
<section id="gallery" class="py-24 bg-gradient-to-br from-gray-50 via-blue-50/30 to-indigo-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <div class="inline-flex items-center px-6 py-3 rounded-full bg-green-100 text-green-800 font-semibold mb-6">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                </svg>
                Galeri
            </div>
            <h2 class="text-5xl lg:text-6xl font-black text-gray-900 mb-8 leading-tight">
                Galeri <span class="bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">Kegiatan</span>
            </h2>
            <p class="text-xl lg:text-2xl text-gray-600 max-w-3xl mx-auto">
                Program-program pencegahan stunting di Puskesmas
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($galleries as $gallery)
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:-translate-y-2">
                <div class="relative overflow-hidden">
                    <img src="{{ Storage::url($gallery->image) }}"
                         alt="{{ $gallery->title }}"
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors duration-300">
                        {{ $gallery->title }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed">{{ Str::limit($gallery->description, 120) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($puskesmas)
<!-- Contact Section -->
<section id="contact" class="py-24 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="1"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <div class="inline-flex items-center px-6 py-3 rounded-full bg-white/10 backdrop-blur-sm text-white font-semibold mb-6">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                </svg>
                Kontak
            </div>
            <h2 class="text-5xl lg:text-6xl font-black mb-8 leading-tight">Hubungi Kami</h2>
            <p class="text-2xl text-blue-100 font-semibold">
                {{ $puskesmas->name }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <div class="space-y-8">
                <h3 class="text-3xl font-bold mb-10">Informasi Kontak</h3>
                <div class="space-y-8">
                    <div class="group flex items-start p-6 bg-white/10 backdrop-blur-sm rounded-2xl hover:bg-white/20 transition-all duration-300">
                        <div class="flex-shrink-0 w-12 h-12 bg-yellow-400 rounded-xl flex items-center justify-center mr-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold mb-2">Alamat</h4>
                            <p class="text-blue-100 leading-relaxed">{{ $puskesmas->address }}</p>
                        </div>
                    </div>

                    <div class="group flex items-start p-6 bg-white/10 backdrop-blur-sm rounded-2xl hover:bg-white/20 transition-all duration-300">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-400 rounded-xl flex items-center justify-center mr-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold mb-2">Telepon</h4>
                            <p class="text-blue-100 leading-relaxed">{{ $puskesmas->phone }}</p>
                        </div>
                    </div>

                    <div class="group flex items-start p-6 bg-white/10 backdrop-blur-sm rounded-2xl hover:bg-white/20 transition-all duration-300">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-400 rounded-xl flex items-center justify-center mr-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold mb-2">Email</h4>
                            <p class="text-blue-100 leading-relaxed">{{ $puskesmas->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-3xl font-bold mb-10">Jadwal Pelayanan</h3>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <pre class="text-blue-100 whitespace-pre-wrap text-lg leading-relaxed">{{ $puskesmas->schedule }}</pre>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-24 bg-gradient-to-r from-yellow-400 via-orange-400 to-orange-500 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23000000" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="1"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <div class="space-y-8">
            <p class="text-xl lg:text-2xl text-gray-800 max-w-3xl mx-auto leading-relaxed">
                Deteksi dini stunting untuk masa depan anak yang lebih cerah.
                Gratis, mudah digunakan, dan terpercaya.
            </p>
        </div>
    </div>
</section>

<style>
@keyframes fade-in-up {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in-right {
    0% {
        opacity: 0;
        transform: translateX(30px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out;
}

.animate-fade-in-right {
    animation: fade-in-right 0.8s ease-out 0.3s both;
}

.shadow-3xl {
    box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
}
</style>
@endsection
