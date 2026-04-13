<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin agar bisa langsung login
        User::create([
            'name' => 'Admin Ayam',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Buat Minimal 3 Menu Ayam
        Produk::create([
            'nama_makanan' => 'Ayam Bakar Madu',
            'harga' => 25000,
            'stok' => 15,
            'jenis_makanan' => 'Bakar',
            'gambar' => 'ayam_bakar.jpg' 
        ]);

        Produk::create([
            'nama_makanan' => 'Ayam Goreng Krispi',
            'harga' => 20000,
            'stok' => 10,
            'jenis_makanan' => 'Goreng',
            'gambar' => 'ayam_goreng.jpg'
        ]);

        Produk::create([
            'nama_makanan' => 'Ayam Geprek Sambal Bawang',
            'harga' => 18000,
            'stok' => 5,
            'jenis_makanan' => 'Pedas',
            'gambar' => 'ayam_geprek.jpg'
        ]);
    }
}