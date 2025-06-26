<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Child extends Model
{
    protected $fillable = [
        'nik',
        'name',
        'gender',
        'birth_date',
        'photo',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

    public function measurements()
    {
        return $this->hasMany(Measurement::class);
    }

    public function getAgeInMonthsAttribute()
    {
        return Carbon::parse($this->birth_date)->diffInMonths(Carbon::now());
    }

    public function getLatestMeasurementAttribute()
    {
        return $this->measurements()->latest()->first();
    }
}
