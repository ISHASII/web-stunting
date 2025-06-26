<?php

namespace App\Services;

use App\Models\WHOStandard;

class ZScoreService
{
    public function calculateZScore($ageMonths, $gender, $height)
    {
        $standard = WHOStandard::where('age_months', $ageMonths)
            ->where('gender', $gender)
            ->first();

        if (!$standard) {
            throw new \Exception('WHO standard data not found for this age and gender');
        }

        if ($height < $standard->median) {
            $zScore = ($height - $standard->median) / ($standard->median - $standard->minus_1sd);
        } else {
            $zScore = ($height - $standard->median) / ($standard->plus_1sd - $standard->median);
        }

        return round($zScore, 2);
    }

    public function getStatus($zScore)
    {
        if ($zScore < -3) {
            return 'Sangat Pendek';
        } elseif ($zScore >= -3 && $zScore < -2) {
            return 'Pendek';
        } elseif ($zScore >= -2 && $zScore <= 3) {
            return 'Normal';
        } else {
            return 'Tinggi';
        }
    }
}