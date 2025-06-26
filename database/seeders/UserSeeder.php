<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@puskesmas.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'superadmin',
            'email_verified_at' => now(),
        ]);

        // Create Sample Petugas
        User::create([
            'name' => 'Dr. Budi Santoso',
            'email' => 'budi@puskesmas.go.id',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Ns. Siti Aminah',
            'email' => 'siti@puskesmas.go.id',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Ahmad Wijaya, SKM',
            'email' => 'ahmad@puskesmas.go.id',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
            'email_verified_at' => now(),
        ]);
    }
}
