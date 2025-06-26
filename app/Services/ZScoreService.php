<?php

namespace App\Services;

use App\Models\WHOStandard;
use Exception;

class ZScoreService
{
    public function calculateZScore($ageMonths, $gender, $height)
    {
        $standard = WHOStandard::where('age_months', $ageMonths)
            ->where('gender', $gender)
            ->first();

        if (!$standard) {
            throw new Exception('Data standar WHO tidak ditemukan untuk usia dan jenis kelamin ini');
        }

        if ($height == $standard->median) {
            return 0.0;
        }

        // Handle kasus pembagi nol (meskipun jarang terjadi dengan data standar)
        $denominator_lower = $standard->median - $standard->minus_1sd;
        $denominator_upper = $standard->plus_1sd - $standard->median;

        if ($height < $standard->median) {
            if ($denominator_lower == 0) throw new Exception('Standar deviasi tidak valid (pembagi nol).');
            $zScore = ($height - $standard->median) / $denominator_lower;
        } else {
            if ($denominator_upper == 0) throw new Exception('Standar deviasi tidak valid (pembagi nol).');
            $zScore = ($height - $standard->median) / $denominator_upper;
        }

        return round($zScore, 2);
    }

    public function getStatus($zScore)
    {
        if ($zScore < -3) {
            return 'Sangat Pendek'; // Severely Stunted
        } elseif ($zScore >= -3 && $zScore < -2) {
            return 'Pendek'; // Stunted
        } elseif ($zScore >= -2 && $zScore <= 3) {
            return 'Normal';
        } else { // $zScore > 3
            return 'Tinggi';
        }
    }
}
