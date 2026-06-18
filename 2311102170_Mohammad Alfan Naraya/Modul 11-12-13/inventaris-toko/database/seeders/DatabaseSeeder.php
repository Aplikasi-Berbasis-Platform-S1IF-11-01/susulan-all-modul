<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun default untuk login admin toko
        User::factory()->create([
            'name' => 'Admin Toko',
            'email' => 'admin@toko.com',
            'password' => bcrypt('password123'),
        ]);

        // Generate 50 data produk otomatis
        Product::factory(50)->create();
    }
}