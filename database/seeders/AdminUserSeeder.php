<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'), // Ganti dengan password aman
            'role' => 'admin', // Pastikan kolom 'role' ada di tabel 'users'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('123'), // Ganti dengan password aman
            'role' => 'user', // Pastikan kolom 'role' ada di tabel 'users'
        ]);
    }
}
