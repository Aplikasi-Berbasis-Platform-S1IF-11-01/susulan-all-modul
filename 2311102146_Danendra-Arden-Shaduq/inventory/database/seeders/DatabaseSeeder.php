<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product; // Wajib dipanggil agar Laravel mengenali tabel Product

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat ulang akun Admin agar kita tetap bisa login
        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@toko.com',
            'password' => bcrypt('password123'),
        ]);

        // 2. Generate 50 data produk secara otomatis!
        Product::factory(50)->create();
    }
}