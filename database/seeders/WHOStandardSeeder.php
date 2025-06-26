<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WHOStandard;

class WHOStandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Data ini diambil dari tabel Standar Antropometri Anak Kemenkes RI (berdasarkan WHO).
     * Sesuai dengan gambar yang dilampirkan.
     */
    public function run(): void
    {
        // Data lengkap Standar Tinggi/Panjang Badan menurut Umur (TB/U atau PB/U)
        // untuk anak laki-laki (L) dan perempuan (P) dari 0-60 bulan.
        $whoData = [
            // Laki-laki (L) | 0-23 bulan (Panjang Badan) & 24-60 bulan (Tinggi Badan)
            ['age_months' => 0, 'gender' => 'L', 'minus_3sd' => 44.2, 'minus_2sd' => 46.1, 'minus_1sd' => 48.0, 'median' => 49.9, 'plus_1sd' => 51.8, 'plus_2sd' => 53.7, 'plus_3sd' => 55.6],
            ['age_months' => 1, 'gender' => 'L', 'minus_3sd' => 48.9, 'minus_2sd' => 50.8, 'minus_1sd' => 52.8, 'median' => 54.7, 'plus_1sd' => 56.7, 'plus_2sd' => 58.6, 'plus_3sd' => 60.6],
            ['age_months' => 2, 'gender' => 'L', 'minus_3sd' => 52.4, 'minus_2sd' => 54.4, 'minus_1sd' => 56.4, 'median' => 58.4, 'plus_1sd' => 60.4, 'plus_2sd' => 62.4, 'plus_3sd' => 64.4],
            ['age_months' => 3, 'gender' => 'L', 'minus_3sd' => 55.3, 'minus_2sd' => 57.3, 'minus_1sd' => 59.4, 'median' => 61.4, 'plus_1sd' => 63.5, 'plus_2sd' => 65.5, 'plus_3sd' => 67.6],
            ['age_months' => 4, 'gender' => 'L', 'minus_3sd' => 57.6, 'minus_2sd' => 59.7, 'minus_1sd' => 61.8, 'median' => 63.9, 'plus_1sd' => 66.0, 'plus_2sd' => 68.0, 'plus_3sd' => 70.1],
            ['age_months' => 5, 'gender' => 'L', 'minus_3sd' => 59.6, 'minus_2sd' => 61.7, 'minus_1sd' => 63.8, 'median' => 65.9, 'plus_1sd' => 68.0, 'plus_2sd' => 70.1, 'plus_3sd' => 72.2],
            ['age_months' => 6, 'gender' => 'L', 'minus_3sd' => 61.2, 'minus_2sd' => 63.3, 'minus_1sd' => 65.5, 'median' => 67.6, 'plus_1sd' => 69.8, 'plus_2sd' => 71.9, 'plus_3sd' => 74.0],
            ['age_months' => 7, 'gender' => 'L', 'minus_3sd' => 62.7, 'minus_2sd' => 64.8, 'minus_1sd' => 67.0, 'median' => 69.2, 'plus_1sd' => 71.3, 'plus_2sd' => 73.5, 'plus_3sd' => 75.7],
            ['age_months' => 8, 'gender' => 'L', 'minus_3sd' => 64.0, 'minus_2sd' => 66.2, 'minus_1sd' => 68.4, 'median' => 70.6, 'plus_1sd' => 72.8, 'plus_2sd' => 75.0, 'plus_3sd' => 77.2],
            ['age_months' => 9, 'gender' => 'L', 'minus_3sd' => 65.2, 'minus_2sd' => 67.5, 'minus_1sd' => 69.7, 'median' => 72.0, 'plus_1sd' => 74.2, 'plus_2sd' => 76.5, 'plus_3sd' => 78.7],
            ['age_months' => 10, 'gender' => 'L', 'minus_3sd' => 66.4, 'minus_2sd' => 68.7, 'minus_1sd' => 71.0, 'median' => 73.3, 'plus_1sd' => 75.6, 'plus_2sd' => 77.9, 'plus_3sd' => 80.1],
            ['age_months' => 11, 'gender' => 'L', 'minus_3sd' => 67.6, 'minus_2sd' => 69.9, 'minus_1sd' => 72.2, 'median' => 74.5, 'plus_1sd' => 76.9, 'plus_2sd' => 79.2, 'plus_3sd' => 81.5],
            ['age_months' => 12, 'gender' => 'L', 'minus_3sd' => 68.6, 'minus_2sd' => 71.0, 'minus_1sd' => 73.4, 'median' => 75.7, 'plus_1sd' => 78.1, 'plus_2sd' => 80.5, 'plus_3sd' => 82.9],
            ['age_months' => 13, 'gender' => 'L', 'minus_3sd' => 69.6, 'minus_2sd' => 72.1, 'minus_1sd' => 74.5, 'median' => 76.9, 'plus_1sd' => 79.3, 'plus_2sd' => 81.8, 'plus_3sd' => 84.2],
            ['age_months' => 14, 'gender' => 'L', 'minus_3sd' => 70.6, 'minus_2sd' => 73.1, 'minus_1sd' => 75.6, 'median' => 78.0, 'plus_1sd' => 80.5, 'plus_2sd' => 83.0, 'plus_3sd' => 85.5],
            ['age_months' => 15, 'gender' => 'L', 'minus_3sd' => 71.6, 'minus_2sd' => 74.1, 'minus_1sd' => 76.6, 'median' => 79.1, 'plus_1sd' => 81.7, 'plus_2sd' => 84.2, 'plus_3sd' => 86.7],
            ['age_months' => 16, 'gender' => 'L', 'minus_3sd' => 72.5, 'minus_2sd' => 75.0, 'minus_1sd' => 77.6, 'median' => 80.2, 'plus_1sd' => 82.8, 'plus_2sd' => 85.4, 'plus_3sd' => 88.0],
            ['age_months' => 17, 'gender' => 'L', 'minus_3sd' => 73.3, 'minus_2sd' => 76.0, 'minus_1sd' => 78.6, 'median' => 81.2, 'plus_1sd' => 83.9, 'plus_2sd' => 86.5, 'plus_3sd' => 89.2],
            ['age_months' => 18, 'gender' => 'L', 'minus_3sd' => 74.2, 'minus_2sd' => 76.9, 'minus_1sd' => 79.6, 'median' => 82.3, 'plus_1sd' => 85.0, 'plus_2sd' => 87.7, 'plus_3sd' => 90.4],
            ['age_months' => 19, 'gender' => 'L', 'minus_3sd' => 75.0, 'minus_2sd' => 77.7, 'minus_1sd' => 80.5, 'median' => 83.2, 'plus_1sd' => 86.0, 'plus_2sd' => 88.8, 'plus_3sd' => 91.5],
            ['age_months' => 20, 'gender' => 'L', 'minus_3sd' => 75.8, 'minus_2sd' => 78.6, 'minus_1sd' => 81.4, 'median' => 84.2, 'plus_1sd' => 87.0, 'plus_2sd' => 89.8, 'plus_3sd' => 92.6],
            ['age_months' => 21, 'gender' => 'L', 'minus_3sd' => 76.5, 'minus_2sd' => 79.4, 'minus_1sd' => 82.3, 'median' => 85.1, 'plus_1sd' => 88.0, 'plus_2sd' => 90.9, 'plus_3sd' => 93.8],
            ['age_months' => 22, 'gender' => 'L', 'minus_3sd' => 77.2, 'minus_2sd' => 80.2, 'minus_1sd' => 83.1, 'median' => 86.0, 'plus_1sd' => 89.0, 'plus_2sd' => 91.9, 'plus_3sd' => 94.9],
            ['age_months' => 23, 'gender' => 'L', 'minus_3sd' => 78.0, 'minus_2sd' => 81.0, 'minus_1sd' => 83.9, 'median' => 86.9, 'plus_1sd' => 89.9, 'plus_2sd' => 92.9, 'plus_3sd' => 95.9],
            ['age_months' => 24, 'gender' => 'L', 'minus_3sd' => 78.0, 'minus_2sd' => 81.0, 'minus_1sd' => 84.1, 'median' => 87.1, 'plus_1sd' => 90.2, 'plus_2sd' => 93.2, 'plus_3sd' => 96.3],
            ['age_months' => 25, 'gender' => 'L', 'minus_3sd' => 78.6, 'minus_2sd' => 81.7, 'minus_1sd' => 84.9, 'median' => 88.0, 'plus_1sd' => 91.1, 'plus_2sd' => 94.2, 'plus_3sd' => 97.3],
            ['age_months' => 26, 'gender' => 'L', 'minus_3sd' => 79.3, 'minus_2sd' => 82.5, 'minus_1sd' => 85.6, 'median' => 88.8, 'plus_1sd' => 92.0, 'plus_2sd' => 95.2, 'plus_3sd' => 98.3],
            ['age_months' => 27, 'gender' => 'L', 'minus_3sd' => 79.9, 'minus_2sd' => 83.1, 'minus_1sd' => 86.4, 'median' => 89.6, 'plus_1sd' => 92.9, 'plus_2sd' => 96.1, 'plus_3sd' => 99.3],
            ['age_months' => 28, 'gender' => 'L', 'minus_3sd' => 80.5, 'minus_2sd' => 83.8, 'minus_1sd' => 87.1, 'median' => 90.4, 'plus_1sd' => 93.7, 'plus_2sd' => 97.0, 'plus_3sd' => 100.3],
            ['age_months' => 29, 'gender' => 'L', 'minus_3sd' => 81.1, 'minus_2sd' => 84.5, 'minus_1sd' => 87.8, 'median' => 91.2, 'plus_1sd' => 94.5, 'plus_2sd' => 97.9, 'plus_3sd' => 101.2],
            ['age_months' => 30, 'gender' => 'L', 'minus_3sd' => 81.7, 'minus_2sd' => 85.1, 'minus_1sd' => 88.5, 'median' => 91.9, 'plus_1sd' => 95.3, 'plus_2sd' => 98.7, 'plus_3sd' => 102.1],
            ['age_months' => 31, 'gender' => 'L', 'minus_3sd' => 82.3, 'minus_2sd' => 85.7, 'minus_1sd' => 89.2, 'median' => 92.7, 'plus_1sd' => 96.1, 'plus_2sd' => 99.6, 'plus_3sd' => 103.0],
            ['age_months' => 32, 'gender' => 'L', 'minus_3sd' => 82.8, 'minus_2sd' => 86.4, 'minus_1sd' => 89.9, 'median' => 93.4, 'plus_1sd' => 96.9, 'plus_2sd' => 100.4, 'plus_3sd' => 103.9],
            ['age_months' => 33, 'gender' => 'L', 'minus_3sd' => 83.4, 'minus_2sd' => 86.9, 'minus_1sd' => 90.5, 'median' => 94.1, 'plus_1sd' => 97.6, 'plus_2sd' => 101.2, 'plus_3sd' => 104.8],
            ['age_months' => 34, 'gender' => 'L', 'minus_3sd' => 83.9, 'minus_2sd' => 87.5, 'minus_1sd' => 91.1, 'median' => 94.8, 'plus_1sd' => 98.4, 'plus_2sd' => 102.0, 'plus_3sd' => 105.6],
            ['age_months' => 35, 'gender' => 'L', 'minus_3sd' => 84.4, 'minus_2sd' => 88.1, 'minus_1sd' => 91.8, 'median' => 95.4, 'plus_1sd' => 99.1, 'plus_2sd' => 102.7, 'plus_3sd' => 106.4],
            ['age_months' => 36, 'gender' => 'L', 'minus_3sd' => 85.0, 'minus_2sd' => 88.7, 'minus_1sd' => 92.4, 'median' => 96.1, 'plus_1sd' => 99.8, 'plus_2sd' => 103.5, 'plus_3sd' => 107.2],
            ['age_months' => 37, 'gender' => 'L', 'minus_3sd' => 85.5, 'minus_2sd' => 89.2, 'minus_1sd' => 93.0, 'median' => 96.7, 'plus_1sd' => 100.5, 'plus_2sd' => 104.2, 'plus_3sd' => 108.0],
            ['age_months' => 38, 'gender' => 'L', 'minus_3sd' => 86.0, 'minus_2sd' => 89.8, 'minus_1sd' => 93.6, 'median' => 97.4, 'plus_1sd' => 101.2, 'plus_2sd' => 105.0, 'plus_3sd' => 108.8],
            ['age_months' => 39, 'gender' => 'L', 'minus_3sd' => 86.5, 'minus_2sd' => 90.3, 'minus_1sd' => 94.2, 'median' => 98.0, 'plus_1sd' => 101.8, 'plus_2sd' => 105.7, 'plus_3sd' => 109.5],
            ['age_months' => 40, 'gender' => 'L', 'minus_3sd' => 87.0, 'minus_2sd' => 90.9, 'minus_1sd' => 94.7, 'median' => 98.6, 'plus_1sd' => 102.5, 'plus_2sd' => 106.4, 'plus_3sd' => 110.3],
            ['age_months' => 41, 'gender' => 'L', 'minus_3sd' => 87.5, 'minus_2sd' => 91.4, 'minus_1sd' => 95.3, 'median' => 99.2, 'plus_1sd' => 103.2, 'plus_2sd' => 107.1, 'plus_3sd' => 111.0],
            ['age_months' => 42, 'gender' => 'L', 'minus_3sd' => 88.0, 'minus_2sd' => 91.9, 'minus_1sd' => 95.9, 'median' => 99.9, 'plus_1sd' => 103.8, 'plus_2sd' => 107.8, 'plus_3sd' => 111.7],
            ['age_months' => 43, 'gender' => 'L', 'minus_3sd' => 88.4, 'minus_2sd' => 92.5, 'minus_1sd' => 96.4, 'median' => 100.4, 'plus_1sd' => 104.5, 'plus_2sd' => 108.5, 'plus_3sd' => 112.5],
            ['age_months' => 44, 'gender' => 'L', 'minus_3sd' => 88.9, 'minus_2sd' => 93.0, 'minus_1sd' => 97.0, 'median' => 101.0, 'plus_1sd' => 105.1, 'plus_2sd' => 109.1, 'plus_3sd' => 113.2],
            ['age_months' => 45, 'gender' => 'L', 'minus_3sd' => 89.4, 'minus_2sd' => 93.5, 'minus_1sd' => 97.5, 'median' => 101.6, 'plus_1sd' => 105.7, 'plus_2sd' => 109.8, 'plus_3sd' => 113.9],
            ['age_months' => 46, 'gender' => 'L', 'minus_3sd' => 89.8, 'minus_2sd' => 94.0, 'minus_1sd' => 98.1, 'median' => 102.2, 'plus_1sd' => 106.3, 'plus_2sd' => 110.4, 'plus_3sd' => 114.6],
            ['age_months' => 47, 'gender' => 'L', 'minus_3sd' => 90.3, 'minus_2sd' => 94.4, 'minus_1sd' => 98.6, 'median' => 102.8, 'plus_1sd' => 106.9, 'plus_2sd' => 111.1, 'plus_3sd' => 115.2],
            ['age_months' => 48, 'gender' => 'L', 'minus_3sd' => 90.7, 'minus_2sd' => 94.9, 'minus_1sd' => 99.1, 'median' => 103.3, 'plus_1sd' => 107.5, 'plus_2sd' => 111.7, 'plus_3sd' => 115.9],
            ['age_months' => 49, 'gender' => 'L', 'minus_3sd' => 91.2, 'minus_2sd' => 95.4, 'minus_1sd' => 99.7, 'median' => 103.9, 'plus_1sd' => 108.1, 'plus_2sd' => 112.4, 'plus_3sd' => 116.6],
            ['age_months' => 50, 'gender' => 'L', 'minus_3sd' => 91.6, 'minus_2sd' => 95.9, 'minus_1sd' => 100.2, 'median' => 104.4, 'plus_1sd' => 108.7, 'plus_2sd' => 113.0, 'plus_3sd' => 117.3],
            ['age_months' => 51, 'gender' => 'L', 'minus_3sd' => 92.1, 'minus_2sd' => 96.4, 'minus_1sd' => 100.7, 'median' => 105.0, 'plus_1sd' => 109.3, 'plus_2sd' => 113.6, 'plus_3sd' => 117.9],
            ['age_months' => 52, 'gender' => 'L', 'minus_3sd' => 92.5, 'minus_2sd' => 96.9, 'minus_1sd' => 101.2, 'median' => 105.6, 'plus_1sd' => 109.9, 'plus_2sd' => 114.2, 'plus_3sd' => 118.6],
            ['age_months' => 53, 'gender' => 'L', 'minus_3sd' => 93.0, 'minus_2sd' => 97.4, 'minus_1sd' => 101.7, 'median' => 106.1, 'plus_1sd' => 110.5, 'plus_2sd' => 114.9, 'plus_3sd' => 119.2],
            ['age_months' => 54, 'gender' => 'L', 'minus_3sd' => 93.4, 'minus_2sd' => 97.8, 'minus_1sd' => 102.3, 'median' => 106.7, 'plus_1sd' => 111.1, 'plus_2sd' => 115.5, 'plus_3sd' => 119.9],
            ['age_months' => 55, 'gender' => 'L', 'minus_3sd' => 93.9, 'minus_2sd' => 98.3, 'minus_1sd' => 102.8, 'median' => 107.2, 'plus_1sd' => 111.7, 'plus_2sd' => 116.1, 'plus_3sd' => 120.6],
            ['age_months' => 56, 'gender' => 'L', 'minus_3sd' => 94.3, 'minus_2sd' => 98.8, 'minus_1sd' => 103.3, 'median' => 107.8, 'plus_1sd' => 112.3, 'plus_2sd' => 116.7, 'plus_3sd' => 121.2],
            ['age_months' => 57, 'gender' => 'L', 'minus_3sd' => 94.7, 'minus_2sd' => 99.3, 'minus_1sd' => 103.8, 'median' => 108.3, 'plus_1sd' => 112.8, 'plus_2sd' => 117.4, 'plus_3sd' => 121.9],
            ['age_months' => 58, 'gender' => 'L', 'minus_3sd' => 95.2, 'minus_2sd' => 99.7, 'minus_1sd' => 104.3, 'median' => 108.9, 'plus_1sd' => 113.4, 'plus_2sd' => 118.0, 'plus_3sd' => 122.6],
            ['age_months' => 59, 'gender' => 'L', 'minus_3sd' => 95.6, 'minus_2sd' => 100.2, 'minus_1sd' => 104.8, 'median' => 109.4, 'plus_1sd' => 114.0, 'plus_2sd' => 118.6, 'plus_3sd' => 123.2],
            ['age_months' => 60, 'gender' => 'L', 'minus_3sd' => 96.1, 'minus_2sd' => 100.7, 'minus_1sd' => 105.3, 'median' => 110.0, 'plus_1sd' => 114.6, 'plus_2sd' => 119.2, 'plus_3sd' => 123.9],

            // Perempuan (P) | 0-23 bulan (Panjang Badan) & 24-60 bulan (Tinggi Badan)
            ['age_months' => 0, 'gender' => 'P', 'minus_3sd' => 43.6, 'minus_2sd' => 45.4, 'minus_1sd' => 47.3, 'median' => 49.1, 'plus_1sd' => 51.0, 'plus_2sd' => 52.9, 'plus_3sd' => 54.7],
            ['age_months' => 1, 'gender' => 'P', 'minus_3sd' => 47.8, 'minus_2sd' => 49.8, 'minus_1sd' => 51.7, 'median' => 53.7, 'plus_1sd' => 55.6, 'plus_2sd' => 57.6, 'plus_3sd' => 59.5],
            ['age_months' => 2, 'gender' => 'P', 'minus_3sd' => 51.0, 'minus_2sd' => 53.0, 'minus_1sd' => 55.0, 'median' => 57.1, 'plus_1sd' => 59.1, 'plus_2sd' => 61.1, 'plus_3sd' => 63.2],
            ['age_months' => 3, 'gender' => 'P', 'minus_3sd' => 53.5, 'minus_2sd' => 55.6, 'minus_1sd' => 57.7, 'median' => 59.8, 'plus_1sd' => 61.9, 'plus_2sd' => 64.0, 'plus_3sd' => 66.1],
            ['age_months' => 4, 'gender' => 'P', 'minus_3sd' => 55.6, 'minus_2sd' => 57.8, 'minus_1sd' => 59.9, 'median' => 62.1, 'plus_1sd' => 64.3, 'plus_2sd' => 66.4, 'plus_3sd' => 68.6],
            ['age_months' => 5, 'gender' => 'P', 'minus_3sd' => 57.4, 'minus_2sd' => 59.6, 'minus_1sd' => 61.8, 'median' => 64.0, 'plus_1sd' => 66.2, 'plus_2sd' => 68.5, 'plus_3sd' => 70.7],
            ['age_months' => 6, 'gender' => 'P', 'minus_3sd' => 58.9, 'minus_2sd' => 61.2, 'minus_1sd' => 63.5, 'median' => 65.7, 'plus_1sd' => 68.0, 'plus_2sd' => 70.3, 'plus_3sd' => 72.5],
            ['age_months' => 7, 'gender' => 'P', 'minus_3sd' => 60.3, 'minus_2sd' => 62.7, 'minus_1sd' => 65.0, 'median' => 67.3, 'plus_1sd' => 69.6, 'plus_2sd' => 71.9, 'plus_3sd' => 74.2],
            ['age_months' => 8, 'gender' => 'P', 'minus_3sd' => 61.7, 'minus_2sd' => 64.0, 'minus_1sd' => 66.4, 'median' => 68.7, 'plus_1sd' => 71.1, 'plus_2sd' => 73.5, 'plus_3sd' => 75.8],
            ['age_months' => 9, 'gender' => 'P', 'minus_3sd' => 62.9, 'minus_2sd' => 65.3, 'minus_1sd' => 67.7, 'median' => 70.1, 'plus_1sd' => 72.6, 'plus_2sd' => 75.0, 'plus_3sd' => 77.4],
            ['age_months' => 10, 'gender' => 'P', 'minus_3sd' => 64.1, 'minus_2sd' => 66.5, 'minus_1sd' => 69.0, 'median' => 71.5, 'plus_1sd' => 73.9, 'plus_2sd' => 76.4, 'plus_3sd' => 78.9],
            ['age_months' => 11, 'gender' => 'P', 'minus_3sd' => 65.2, 'minus_2sd' => 67.7, 'minus_1sd' => 70.3, 'median' => 72.8, 'plus_1sd' => 75.3, 'plus_2sd' => 77.8, 'plus_3sd' => 80.3],
            ['age_months' => 12, 'gender' => 'P', 'minus_3sd' => 66.3, 'minus_2sd' => 68.9, 'minus_1sd' => 71.4, 'median' => 74.0, 'plus_1sd' => 76.6, 'plus_2sd' => 79.2, 'plus_3sd' => 81.7],
            ['age_months' => 13, 'gender' => 'P', 'minus_3sd' => 67.3, 'minus_2sd' => 70.0, 'minus_1sd' => 72.6, 'median' => 75.2, 'plus_1sd' => 77.8, 'plus_2sd' => 80.5, 'plus_3sd' => 83.1],
            ['age_months' => 14, 'gender' => 'P', 'minus_3sd' => 68.3, 'minus_2sd' => 71.0, 'minus_1sd' => 73.7, 'median' => 76.4, 'plus_1sd' => 79.1, 'plus_2sd' => 81.7, 'plus_3sd' => 84.4],
            ['age_months' => 15, 'gender' => 'P', 'minus_3sd' => 69.3, 'minus_2sd' => 72.0, 'minus_1sd' => 74.8, 'median' => 77.5, 'plus_1sd' => 80.2, 'plus_2sd' => 83.0, 'plus_3sd' => 85.7],
            ['age_months' => 16, 'gender' => 'P', 'minus_3sd' => 70.2, 'minus_2sd' => 73.0, 'minus_1sd' => 75.8, 'median' => 78.6, 'plus_1sd' => 81.4, 'plus_2sd' => 84.2, 'plus_3sd' => 87.0],
            ['age_months' => 17, 'gender' => 'P', 'minus_3sd' => 71.1, 'minus_2sd' => 74.0, 'minus_1sd' => 76.8, 'median' => 79.7, 'plus_1sd' => 82.5, 'plus_2sd' => 85.4, 'plus_3sd' => 88.2],
            ['age_months' => 18, 'gender' => 'P', 'minus_3sd' => 72.0, 'minus_2sd' => 74.9, 'minus_1sd' => 77.8, 'median' => 80.7, 'plus_1sd' => 83.6, 'plus_2sd' => 86.5, 'plus_3sd' => 89.4],
            ['age_months' => 19, 'gender' => 'P', 'minus_3sd' => 72.8, 'minus_2sd' => 75.8, 'minus_1sd' => 78.8, 'median' => 81.7, 'plus_1sd' => 84.7, 'plus_2sd' => 87.6, 'plus_3sd' => 90.6],
            ['age_months' => 20, 'gender' => 'P', 'minus_3sd' => 73.7, 'minus_2sd' => 76.7, 'minus_1sd' => 79.7, 'median' => 82.7, 'plus_1sd' => 85.7, 'plus_2sd' => 88.7, 'plus_3sd' => 91.7],
            ['age_months' => 21, 'gender' => 'P', 'minus_3sd' => 74.5, 'minus_2sd' => 77.5, 'minus_1sd' => 80.6, 'median' => 83.7, 'plus_1sd' => 86.7, 'plus_2sd' => 89.8, 'plus_3sd' => 92.9],
            ['age_months' => 22, 'gender' => 'P', 'minus_3sd' => 75.2, 'minus_2sd' => 78.4, 'minus_1sd' => 81.5, 'median' => 84.6, 'plus_1sd' => 87.7, 'plus_2sd' => 90.8, 'plus_3sd' => 94.0],
            ['age_months' => 23, 'gender' => 'P', 'minus_3sd' => 76.0, 'minus_2sd' => 79.2, 'minus_1sd' => 82.3, 'median' => 85.5, 'plus_1sd' => 88.7, 'plus_2sd' => 91.9, 'plus_3sd' => 95.0],
            ['age_months' => 24, 'gender' => 'P', 'minus_3sd' => 76.0, 'minus_2sd' => 79.3, 'minus_1sd' => 82.5, 'median' => 85.7, 'plus_1sd' => 88.9, 'plus_2sd' => 92.2, 'plus_3sd' => 95.4],
            ['age_months' => 25, 'gender' => 'P', 'minus_3sd' => 76.8, 'minus_2sd' => 80.0, 'minus_1sd' => 83.3, 'median' => 86.6, 'plus_1sd' => 89.9, 'plus_2sd' => 93.1, 'plus_3sd' => 96.4],
            ['age_months' => 26, 'gender' => 'P', 'minus_3sd' => 77.5, 'minus_2sd' => 80.8, 'minus_1sd' => 84.1, 'median' => 87.4, 'plus_1sd' => 90.8, 'plus_2sd' => 94.1, 'plus_3sd' => 97.4],
            ['age_months' => 27, 'gender' => 'P', 'minus_3sd' => 78.1, 'minus_2sd' => 81.5, 'minus_1sd' => 84.9, 'median' => 88.3, 'plus_1sd' => 91.7, 'plus_2sd' => 95.0, 'plus_3sd' => 98.4],
            ['age_months' => 28, 'gender' => 'P', 'minus_3sd' => 78.8, 'minus_2sd' => 82.2, 'minus_1sd' => 85.7, 'median' => 89.1, 'plus_1sd' => 92.5, 'plus_2sd' => 96.0, 'plus_3sd' => 99.4],
            ['age_months' => 29, 'gender' => 'P', 'minus_3sd' => 79.5, 'minus_2sd' => 82.9, 'minus_1sd' => 86.4, 'median' => 89.9, 'plus_1sd' => 93.4, 'plus_2sd' => 96.9, 'plus_3sd' => 100.3],
            ['age_months' => 30, 'gender' => 'P', 'minus_3sd' => 80.1, 'minus_2sd' => 83.6, 'minus_1sd' => 87.1, 'median' => 90.7, 'plus_1sd' => 94.2, 'plus_2sd' => 97.7, 'plus_3sd' => 101.3],
            ['age_months' => 31, 'gender' => 'P', 'minus_3sd' => 80.7, 'minus_2sd' => 84.3, 'minus_1sd' => 87.9, 'median' => 91.4, 'plus_1sd' => 95.0, 'plus_2sd' => 98.6, 'plus_3sd' => 102.2],
            ['age_months' => 32, 'gender' => 'P', 'minus_3sd' => 81.3, 'minus_2sd' => 84.9, 'minus_1sd' => 88.6, 'median' => 92.2, 'plus_1sd' => 95.8, 'plus_2sd' => 99.4, 'plus_3sd' => 103.1],
            ['age_months' => 33, 'gender' => 'P', 'minus_3sd' => 81.9, 'minus_2sd' => 85.6, 'minus_1sd' => 89.3, 'median' => 92.9, 'plus_1sd' => 96.6, 'plus_2sd' => 100.3, 'plus_3sd' => 103.9],
            ['age_months' => 34, 'gender' => 'P', 'minus_3sd' => 82.5, 'minus_2sd' => 86.2, 'minus_1sd' => 89.9, 'median' => 93.6, 'plus_1sd' => 97.4, 'plus_2sd' => 101.1, 'plus_3sd' => 104.8],
            ['age_months' => 35, 'gender' => 'P', 'minus_3sd' => 83.1, 'minus_2sd' => 86.8, 'minus_1sd' => 90.6, 'median' => 94.4, 'plus_1sd' => 98.1, 'plus_2sd' => 101.9, 'plus_3sd' => 105.6],
            ['age_months' => 36, 'gender' => 'P', 'minus_3sd' => 83.6, 'minus_2sd' => 87.4, 'minus_1sd' => 91.2, 'median' => 95.1, 'plus_1sd' => 98.9, 'plus_2sd' => 102.7, 'plus_3sd' => 106.5],
            ['age_months' => 37, 'gender' => 'P', 'minus_3sd' => 84.2, 'minus_2sd' => 88.0, 'minus_1sd' => 91.9, 'median' => 95.7, 'plus_1sd' => 99.6, 'plus_2sd' => 103.4, 'plus_3sd' => 107.3],
            ['age_months' => 38, 'gender' => 'P', 'minus_3sd' => 84.7, 'minus_2sd' => 88.6, 'minus_1sd' => 92.5, 'median' => 96.4, 'plus_1sd' => 100.3, 'plus_2sd' => 104.2, 'plus_3sd' => 108.1],
            ['age_months' => 39, 'gender' => 'P', 'minus_3sd' => 85.3, 'minus_2sd' => 89.2, 'minus_1sd' => 93.1, 'median' => 97.1, 'plus_1sd' => 101.0, 'plus_2sd' => 105.0, 'plus_3sd' => 108.9],
            ['age_months' => 40, 'gender' => 'P', 'minus_3sd' => 85.8, 'minus_2sd' => 89.8, 'minus_1sd' => 93.8, 'median' => 97.7, 'plus_1sd' => 101.7, 'plus_2sd' => 105.7, 'plus_3sd' => 109.7],
            ['age_months' => 41, 'gender' => 'P', 'minus_3sd' => 86.3, 'minus_2sd' => 90.4, 'minus_1sd' => 94.4, 'median' => 98.4, 'plus_1sd' => 102.4, 'plus_2sd' => 106.4, 'plus_3sd' => 110.5],
            ['age_months' => 42, 'gender' => 'P', 'minus_3sd' => 86.8, 'minus_2sd' => 90.9, 'minus_1sd' => 95.0, 'median' => 99.0, 'plus_1sd' => 103.1, 'plus_2sd' => 107.2, 'plus_3sd' => 111.2],
            ['age_months' => 43, 'gender' => 'P', 'minus_3sd' => 87.4, 'minus_2sd' => 91.5, 'minus_1sd' => 95.6, 'median' => 99.7, 'plus_1sd' => 103.8, 'plus_2sd' => 107.9, 'plus_3sd' => 112.0],
            ['age_months' => 44, 'gender' => 'P', 'minus_3sd' => 87.9, 'minus_2sd' => 92.0, 'minus_1sd' => 96.2, 'median' => 100.3, 'plus_1sd' => 104.5, 'plus_2sd' => 108.6, 'plus_3sd' => 112.7],
            ['age_months' => 45, 'gender' => 'P', 'minus_3sd' => 88.4, 'minus_2sd' => 92.5, 'minus_1sd' => 96.7, 'median' => 100.9, 'plus_1sd' => 105.1, 'plus_2sd' => 109.3, 'plus_3sd' => 113.5],
            ['age_months' => 46, 'gender' => 'P', 'minus_3sd' => 88.9, 'minus_2sd' => 93.1, 'minus_1sd' => 97.3, 'median' => 101.5, 'plus_1sd' => 105.8, 'plus_2sd' => 110.0, 'plus_3sd' => 114.2],
            ['age_months' => 47, 'gender' => 'P', 'minus_3sd' => 89.3, 'minus_2sd' => 93.6, 'minus_1sd' => 97.9, 'median' => 102.1, 'plus_1sd' => 106.4, 'plus_2sd' => 110.7, 'plus_3sd' => 114.9],
            ['age_months' => 48, 'gender' => 'P', 'minus_3sd' => 89.8, 'minus_2sd' => 94.1, 'minus_1sd' => 98.4, 'median' => 102.7, 'plus_1sd' => 107.0, 'plus_2sd' => 111.3, 'plus_3sd' => 115.7],
            ['age_months' => 49, 'gender' => 'P', 'minus_3sd' => 90.3, 'minus_2sd' => 94.6, 'minus_1sd' => 99.0, 'median' => 103.3, 'plus_1sd' => 107.7, 'plus_2sd' => 112.0, 'plus_3sd' => 116.4],
            ['age_months' => 50, 'gender' => 'P', 'minus_3sd' => 90.7, 'minus_2sd' => 95.1, 'minus_1sd' => 99.5, 'median' => 103.9, 'plus_1sd' => 108.3, 'plus_2sd' => 112.7, 'plus_3sd' => 117.1],
            ['age_months' => 51, 'gender' => 'P', 'minus_3sd' => 91.2, 'minus_2sd' => 95.6, 'minus_1sd' => 100.1, 'median' => 104.5, 'plus_1sd' => 108.9, 'plus_2sd' => 113.3, 'plus_3sd' => 117.7],
            ['age_months' => 52, 'gender' => 'P', 'minus_3sd' => 91.7, 'minus_2sd' => 96.1, 'minus_1sd' => 100.6, 'median' => 105.0, 'plus_1sd' => 109.5, 'plus_2sd' => 114.0, 'plus_3sd' => 118.4],
            ['age_months' => 53, 'gender' => 'P', 'minus_3sd' => 92.1, 'minus_2sd' => 96.6, 'minus_1sd' => 101.1, 'median' => 105.6, 'plus_1sd' => 110.1, 'plus_2sd' => 114.6, 'plus_3sd' => 119.1],
            ['age_months' => 54, 'gender' => 'P', 'minus_3sd' => 92.6, 'minus_2sd' => 97.1, 'minus_1sd' => 101.6, 'median' => 106.2, 'plus_1sd' => 110.7, 'plus_2sd' => 115.2, 'plus_3sd' => 119.8],
            ['age_months' => 55, 'gender' => 'P', 'minus_3sd' => 93.0, 'minus_2sd' => 97.6, 'minus_1sd' => 102.2, 'median' => 106.7, 'plus_1sd' => 111.3, 'plus_2sd' => 115.9, 'plus_3sd' => 120.4],
            ['age_months' => 56, 'gender' => 'P', 'minus_3sd' => 93.4, 'minus_2sd' => 98.1, 'minus_1sd' => 102.7, 'median' => 107.3, 'plus_1sd' => 111.9, 'plus_2sd' => 116.5, 'plus_3sd' => 121.1],
            ['age_months' => 57, 'gender' => 'P', 'minus_3sd' => 93.9, 'minus_2sd' => 98.5, 'minus_1sd' => 103.2, 'median' => 107.8, 'plus_1sd' => 112.5, 'plus_2sd' => 117.1, 'plus_3sd' => 121.8],
            ['age_months' => 58, 'gender' => 'P', 'minus_3sd' => 94.3, 'minus_2sd' => 99.0, 'minus_1sd' => 103.7, 'median' => 108.4, 'plus_1sd' => 113.0, 'plus_2sd' => 117.7, 'plus_3sd' => 122.4],
            ['age_months' => 59, 'gender' => 'P', 'minus_3sd' => 94.7, 'minus_2sd' => 99.5, 'minus_1sd' => 104.2, 'median' => 108.9, 'plus_1sd' => 113.6, 'plus_2sd' => 118.3, 'plus_3sd' => 123.1],
            ['age_months' => 60, 'gender' => 'P', 'minus_3sd' => 95.2, 'minus_2sd' => 99.9, 'minus_1sd' => 104.7, 'median' => 109.4, 'plus_1sd' => 114.2, 'plus_2sd' => 118.9, 'plus_3sd' => 123.7],
        ];

        // Kosongkan tabel sebelum mengisi untuk menghindari duplikasi data
        WHOStandard::query()->delete();

        // Loop melalui data lengkap dan masukan ke dalam database
        foreach ($whoData as $data) {
            WHOStandard::create($data);
        }
    }
}
