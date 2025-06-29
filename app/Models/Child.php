<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'name',
        'gender',
        'birth_date',
        'photo'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function measurements()
    {
        return $this->hasMany(Measurement::class);
    }

    // Add the missing latest_measurement relationship
    public function latest_measurement()
    {
        return $this->hasOne(Measurement::class)->latest('measurement_date');
    }

    // Alternative: Get the latest measurement as an attribute
    public function getLatestMeasurementAttribute()
    {
        return $this->measurements()->latest('measurement_date')->first();
    }

    // Helper method to get measurement count
    public function getMeasurementCountAttribute()
    {
        return $this->measurements()->count();
    }

    // Helper method to get age in months
    public function getAgeInMonthsAttribute()
    {
        return $this->birth_date ? $this->birth_date->diffInMonths(now()) : null;
    }

    // Helper method to get age display
    public function getAgeDisplayAttribute()
    {
        if (!$this->birth_date) return '-';

        $years = $this->birth_date->diffInYears(now());
        $months = $this->birth_date->copy()->addYears($years)->diffInMonths(now());

        if ($years > 0) {
            return $years . ' tahun ' . $months . ' bulan';
        } else {
            return $months . ' bulan';
        }
    }

    // Helper method to get the latest status
    public function getLatestStatusAttribute()
    {
        $latestMeasurement = $this->latest_measurement;
        return $latestMeasurement ? $latestMeasurement->status : 'Belum ada pengukuran';
    }

    // Helper method to get status color class
    public function getStatusColorClassAttribute()
    {
        if (!$this->latest_measurement) {
            return 'bg-gray-100 text-gray-800';
        }

        return match($this->latest_measurement->status) {
            'Sangat Pendek' => 'bg-red-100 text-red-800',
            'Pendek' => 'bg-orange-100 text-orange-800',
            'Normal' => 'bg-green-100 text-green-800',
            'Tinggi' => 'bg-purple-100 text-purple-800',
            default => 'bg-blue-100 text-blue-800'
        };
    }

    // Static method to get available status options
    public static function getStatusOptions()
    {
        return [
            'Normal' => 'Normal',
            'Pendek' => 'Pendek (Stunting)',
            'Sangat Pendek' => 'Sangat Pendek (Severe Stunting)',
            'Tinggi' => 'Tinggi'
        ];
    }
}
