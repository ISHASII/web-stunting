<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puskesmas extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'schedule',
    ];
}
