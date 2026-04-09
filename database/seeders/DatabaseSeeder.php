<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // Password default: password
            'role' => 'admin',
        ]);

        // Membuat Akun Kasir
        User::create([
            'name' => 'Kasir Utama',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('password'), // Password default: password
            'role' => 'kasir',
        ]);

        // Opsional: Generate beberapa data kasir lain secara acak jika menggunakan factory
        // User::factory(5)->create(['role' => 'kasir']);
    }
}