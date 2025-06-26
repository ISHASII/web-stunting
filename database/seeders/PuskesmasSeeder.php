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
            'name' => 'Puskesmas Sukamaju',
            'address' => 'Jl. Raya Sukamaju No. 123, Kecamatan Sukamaju, Kabupaten Bandung, Jawa Barat 40123',
            'phone' => '(022) 1234567',
            'email' => 'info@puskesmassukamaju.go.id',
            'schedule' => "Senin - Jumat: 08.00 - 15.00 WIB\nSabtu: 08.00 - 12.00 WIB\nMinggu: Tutup\n\nLayanan 24 Jam:\n- UGD\n- Persalinan\n\nPelayanan Khusus:\n- Posyandu: Setiap Rabu minggu ke-2\n- Imunisasi: Setiap hari kerja\n- KB: Senin, Rabu, Jumat",
        ]);
    }
}