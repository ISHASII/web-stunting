<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'user_id',
        'age_months',
        'height',
        'weight',
        'head_circumference',
        'arm_circumference',
        'z_score',
        'status',
        'measurement_date'
    ];

    protected $casts = [
        'height' => 'decimal:2',
        'weight' => 'decimal:2',
        'head_circumference' => 'decimal:2',
        'arm_circumference' => 'decimal:2',
        'z_score' => 'decimal:2',
        'measurement_date' => 'datetime',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
