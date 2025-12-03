<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun ADMIN (Bisa Segalanya)
        User::create([
            'name' => 'Ryan Admin',
            'email' => 'admin@toko.com',
            'password' => Hash::make('password'), // passwordnya: password
            'role' => 'admin',
        ]);

        // 2. Buat Akun STAFF (Cuma Bisa Lihat)
        User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@toko.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}