<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Kegiatan Posyandu Balita',
                'description' => 'Pemeriksaan rutin kesehatan balita dan pemberian imunisasi di Posyandu RW 05. Kegiatan ini dilakukan setiap bulan untuk memantau tumbuh kembang anak.',
                'image' => 'gallery-images/posyandu-1.jpg', // You need to add actual images
            ],
            [
                'title' => 'Penyuluhan Gizi Seimbang',
                'description' => 'Sosialisasi tentang pentingnya gizi seimbang untuk mencegah stunting kepada para ibu hamil dan menyusui di wilayah kerja Puskesmas.',
                'image' => 'gallery-images/penyuluhan-gizi.jpg',
            ],
            [
                'title' => 'Program 1000 Hari Pertama Kehidupan',
                'description' => 'Edukasi kepada ibu hamil tentang pentingnya 1000 hari pertama kehidupan untuk mencegah stunting pada anak.',
                'image' => 'gallery-images/1000-hari.jpg',
            ],
            [
                'title' => 'Monitoring Pertumbuhan Anak',
                'description' => 'Kegiatan rutin pengukuran tinggi dan berat badan anak untuk deteksi dini stunting di berbagai posyandu wilayah kerja.',
                'image' => 'gallery-images/monitoring.jpg',
            ],
            [
                'title' => 'Pemberian Makanan Tambahan',
                'description' => 'Program pemberian makanan tambahan untuk balita yang mengalami gizi kurang sebagai upaya pencegahan stunting.',
                'image' => 'gallery-images/pmt.jpg',
            ],
            [
                'title' => 'Kelas Ibu Hamil',
                'description' => 'Kelas edukasi untuk ibu hamil tentang nutrisi selama kehamilan dan persiapan menyusui eksklusif.',
                'image' => 'gallery-images/kelas-bumil.jpg',
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}