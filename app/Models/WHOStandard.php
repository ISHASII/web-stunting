<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WHOStandard extends Model
{
    protected $table = 'who_standards';

    protected $fillable = [
        'age_months',
        'gender',
        'minus_3sd',
        'minus_2sd',
        'minus_1sd',
        'median',
        'plus_1sd',
        'plus_2sd',
        'plus_3sd',
    ];

    protected function casts(): array
    {
        return [
            'minus_3sd' => 'decimal:2',
            'minus_2sd' => 'decimal:2',
            'minus_1sd' => 'decimal:2',
            'median' => 'decimal:2',
            'plus_1sd' => 'decimal:2',
            'plus_2sd' => 'decimal:2',
            'plus_3sd' => 'decimal:2',
        ];
    }
}
