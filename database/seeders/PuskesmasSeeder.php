<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Puskesmas;

class PuskesmasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Puskesmas::create([
            'name' => 'Puskesmas Loji',
            'address' => 'Jl. Raya Loji Karawang, Kampung Munjul RT 02/ RW 01,  Desa Cintalaksana, Tegalwaru, Karawang 41326',
            'phone' => '+62 855-4514-0211',
            'email' => 'puskesmasloji@gmail.com',
            'schedule' => "Senin - Jumat: 08.00 - 15.00 WIB\nSabtu: 08.00 - 12.00 WIB\nMinggu: Tutup\n\nLayanan 24 Jam:\n- UGD\n- Persalinan\n\nPelayanan Khusus:\n- Posyandu: Setiap Rabu minggu ke-2\n- Imunisasi: Setiap hari kerja\n- KB: Senin, Rabu, Jumat",
        ]);
    }
}