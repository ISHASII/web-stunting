<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function measurements()
    {
        return $this->hasMany(Measurement::class, 'user_id');
    }

    public function isSuperadmin()
    {
        return $this->role === 'superadmin';
    }

    public function isPetugas()
    {
        return $this->role === 'petugas';
    }

    public function isAdmin()
    {
        return $this->role === 'admin' || $this->role === 'superadmin';
    }
}
