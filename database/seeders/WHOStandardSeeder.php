<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WHOStandard;

class WHOStandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data WHO Standards untuk Height-for-Age (Length/Height-for-age)
        // Data untuk anak laki-laki (L) dan perempuan (P) dari 0-60 bulan

        $whoData = [
            // Laki-laki (L)
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
            ['age_months' => 24, 'gender' => 'L', 'minus_3sd' => 78.7, 'minus_2sd' => 81.7, 'minus_1sd' => 84.8, 'median' => 87.8, 'plus_1sd' => 90.9, 'plus_2sd' => 93.9, 'plus_3sd' => 97.0],

            // Data untuk usia 25-60 bulan (Laki-laki)
            ['age_months' => 25, 'gender' => 'L', 'minus_3sd' => 79.3, 'minus_2sd' => 82.5, 'minus_1sd' => 85.6, 'median' => 88.7, 'plus_1sd' => 91.9, 'plus_2sd' => 95.0, 'plus_3sd' => 98.1],
            ['age_months' => 26, 'gender' => 'L', 'minus_3sd' => 80.0, 'minus_2sd' => 83.2, 'minus_1sd' => 86.4, 'median' => 89.6, 'plus_1sd' => 92.8, 'plus_2sd' => 96.0, 'plus_3sd' => 99.2],
            ['age_months' => 27, 'gender' => 'L', 'minus_3sd' => 80.7, 'minus_2sd' => 84.0, 'minus_1sd' => 87.2, 'median' => 90.4, 'plus_1sd' => 93.7, 'plus_2sd' => 96.9, 'plus_3sd' => 100.3],
            ['age_months' => 28, 'gender' => 'L', 'minus_3sd' => 81.3, 'minus_2sd' => 84.7, 'minus_1sd' => 88.0, 'median' => 91.3, 'plus_1sd' => 94.7, 'plus_2sd' => 98.0, 'plus_3sd' => 101.3],
            ['age_months' => 29, 'gender' => 'L', 'minus_3sd' => 81.9, 'minus_2sd' => 85.4, 'minus_1sd' => 88.8, 'median' => 92.1, 'plus_1sd' => 95.6, 'plus_2sd' => 99.0, 'plus_3sd' => 102.4],
            ['age_months' => 30, 'gender' => 'L', 'minus_3sd' => 82.5, 'minus_2sd' => 86.1, 'minus_1sd' => 89.6, 'median' => 93.0, 'plus_1sd' => 96.5, 'plus_2sd' => 100.0, 'plus_3sd' => 103.5],
            ['age_months' => 36, 'gender' => 'L', 'minus_3sd' => 85.7, 'minus_2sd' => 89.5, 'minus_1sd' => 93.2, 'median' => 96.9, 'plus_1sd' => 100.7, 'plus_2sd' => 104.5, 'plus_3sd' => 108.3],
            ['age_months' => 42, 'gender' => 'L', 'minus_3sd' => 88.4, 'minus_2sd' => 92.4, 'minus_1sd' => 96.4, 'median' => 100.4, 'plus_1sd' => 104.5, 'plus_2sd' => 108.5, 'plus_3sd' => 112.5],
            ['age_months' => 48, 'gender' => 'L', 'minus_3sd' => 90.9, 'minus_2sd' => 95.0, 'minus_1sd' => 99.1, 'median' => 103.3, 'plus_1sd' => 107.5, 'plus_2sd' => 111.7, 'plus_3sd' => 115.9],
            ['age_months' => 54, 'gender' => 'L', 'minus_3sd' => 93.1, 'minus_2sd' => 97.4, 'minus_1sd' => 101.7, 'median' => 106.1, 'plus_1sd' => 110.5, 'plus_2sd' => 114.9, 'plus_3sd' => 119.3],
            ['age_months' => 60, 'gender' => 'L', 'minus_3sd' => 95.2, 'minus_2sd' => 99.7, 'minus_1sd' => 104.2, 'median' => 108.7, 'plus_1sd' => 113.3, 'plus_2sd' => 117.9, 'plus_3sd' => 122.5],

            // Perempuan (P)
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
            ['age_months' => 10, 'gender' => 'P', 'minus_3sd' => 64.1, 'minus_2sd' => 66.5, 'minus_1sd' => 69.0, 'median' => 71.5, 'plus_1sd' => 74.0, 'plus_2sd' => 76.4, 'plus_3sd' => 78.9],
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
            ['age_months' => 24, 'gender' => 'P', 'minus_3sd' => 76.7, 'minus_2sd' => 80.0, 'minus_1sd' => 83.2, 'median' => 86.4, 'plus_1sd' => 89.6, 'plus_2sd' => 92.9, 'plus_3sd' => 96.1],

            // Data untuk usia 25-60 bulan (Perempuan)
            ['age_months' => 25, 'gender' => 'P', 'minus_3sd' => 77.5, 'minus_2sd' => 80.8, 'minus_1sd' => 84.0, 'median' => 87.3, 'plus_1sd' => 90.6, 'plus_2sd' => 93.9, 'plus_3sd' => 97.2],
            ['age_months' => 26, 'gender' => 'P', 'minus_3sd' => 78.2, 'minus_2sd' => 81.5, 'minus_1sd' => 84.9, 'median' => 88.2, 'plus_1sd' => 91.5, 'plus_2sd' => 94.9, 'plus_3sd' => 98.3],
            ['age_months' => 27, 'gender' => 'P', 'minus_3sd' => 78.9, 'minus_2sd' => 82.3, 'minus_1sd' => 85.7, 'median' => 89.1, 'plus_1sd' => 92.5, 'plus_2sd' => 95.9, 'plus_3sd' => 99.3],
            ['age_months' => 28, 'gender' => 'P', 'minus_3sd' => 79.6, 'minus_2sd' => 83.1, 'minus_1sd' => 86.5, 'median' => 89.9, 'plus_1sd' => 93.4, 'plus_2sd' => 96.8, 'plus_3sd' => 100.3],
            ['age_months' => 29, 'gender' => 'P', 'minus_3sd' => 80.3, 'minus_2sd' => 83.8, 'minus_1sd' => 87.3, 'median' => 90.8, 'plus_1sd' => 94.4, 'plus_2sd' => 97.9, 'plus_3sd' => 101.4],
            ['age_months' => 30, 'gender' => 'P', 'minus_3sd' => 81.0, 'minus_2sd' => 84.5, 'minus_1sd' => 88.1, 'median' => 91.7, 'plus_1sd' => 95.3, 'plus_2sd' => 98.9, 'plus_3sd' => 102.5],
            ['age_months' => 36, 'gender' => 'P', 'minus_3sd' => 83.6, 'minus_2sd' => 87.4, 'minus_1sd' => 91.2, 'median' => 95.1, 'plus_1sd' => 99.0, 'plus_2sd' => 102.9, 'plus_3sd' => 106.8],
            ['age_months' => 42, 'gender' => 'P', 'minus_3sd' => 86.0, 'minus_2sd' => 90.0, 'minus_1sd' => 94.1, 'median' => 98.1, 'plus_1sd' => 102.2, 'plus_2sd' => 106.3, 'plus_3sd' => 110.4],
            ['age_months' => 48, 'gender' => 'P', 'minus_3sd' => 88.3, 'minus_2sd' => 92.5, 'minus_1sd' => 96.7, 'median' => 100.9, 'plus_1sd' => 105.2, 'plus_2sd' => 109.4, 'plus_3sd' => 113.6],
            ['age_months' => 54, 'gender' => 'P', 'minus_3sd' => 90.4, 'minus_2sd' => 94.7, 'minus_1sd' => 99.1, 'median' => 103.5, 'plus_1sd' => 107.9, 'plus_2sd' => 112.3, 'plus_3sd' => 116.7],
            ['age_months' => 60, 'gender' => 'P', 'minus_3sd' => 92.4, 'minus_2sd' => 96.9, 'minus_1sd' => 101.4, 'median' => 105.9, 'plus_1sd' => 110.5, 'plus_2sd' => 115.0, 'plus_3sd' => 119.6],
        ];

        // Insert data lengkap untuk setiap bulan dari 0-60
        foreach (range(0, 60) as $month) {
            foreach (['L', 'P'] as $gender) {
                // Cari data yang sudah ada
                $existingData = collect($whoData)->where('age_months', $month)->where('gender', $gender)->first();

                if ($existingData) {
                    WHOStandard::create($existingData);
                } else {
                    // Jika data tidak ada, interpolasi dari data terdekat
                    $interpolatedData = $this->interpolateData($whoData, $month, $gender);
                    if ($interpolatedData) {
                        WHOStandard::create($interpolatedData);
                    }
                }
            }
        }
    }

    /**
     * Interpolate data for missing months
     */
    private function interpolateData($data, $targetMonth, $gender)
    {
        $genderData = collect($data)->where('gender', $gender)->sortBy('age_months');

        // Find nearest data points
        $before = $genderData->where('age_months', '<=', $targetMonth)->last();
        $after = $genderData->where('age_months', '>=', $targetMonth)->first();

        if (!$before || !$after) {
            return null;
        }

        if ($before['age_months'] == $after['age_months']) {
            return $before;
        }

        // Linear interpolation
        $ratio = ($targetMonth - $before['age_months']) / ($after['age_months'] - $before['age_months']);

        $interpolated = [
            'age_months' => $targetMonth,
            'gender' => $gender,
        ];

        foreach (['minus_3sd', 'minus_2sd', 'minus_1sd', 'median', 'plus_1sd', 'plus_2sd', 'plus_3sd'] as $field) {
            $interpolated[$field] = round($before[$field] + ($after[$field] - $before[$field]) * $ratio, 2);
        }

        return $interpolated;
    }
}
