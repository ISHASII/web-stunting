<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = [
        'child_id',
        'user_id',
        'age_months',
        'height',
        'z_score',
        'status',
        'measurement_date',
    ];

    protected function casts(): array
    {
        return [
            'measurement_date' => 'date',
            'height' => 'decimal:2',
            'z_score' => 'decimal:2',
        ];
    }

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
