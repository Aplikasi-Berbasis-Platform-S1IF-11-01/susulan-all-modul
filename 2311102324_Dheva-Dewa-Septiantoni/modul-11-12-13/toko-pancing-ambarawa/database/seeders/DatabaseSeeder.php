<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin (Pemilik Toko)
        User::create([
            'name' => 'Owner Toko Pancing',
            'email' => 'adminpancing@toko.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // 2. Akun User (Pembeli / Angler)
        User::create([
            'name' => 'Mamat Angler',
            'email' => 'mamatpancing@gmail.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        // 3. Data Dummy Alat Pancing Awal
        Product::create([
            'name' => 'Joran Carbon Shimano Catana 180',
            'category' => 'Joran',
            'price' => 850000,
            'stock' => 12,
            'description' => 'Joran carbon premium, panjang 180cm, lentur dan sangat kuat untuk teknik casting.',
        ]);

        Product::create([
            'name' => 'Reel Ryobi Ultegra 4000 HP',
            'category' => 'Reel',
            'price' => 1200000,
            'stock' => 8,
            'description' => 'Reel pancing dengan 5+1 ball bearings, putaran halus cocok untuk target ikan besar.',
        ]);

        Product::create([
            'name' => 'Umpan Lure Minnow Floating 15g',
            'category' => 'Umpan',
            'price' => 45000,
            'stock' => 35,
            'description' => 'Umpan tiruan berbentuk ikan kecil dengan mata 3D untuk menarik perhatian predator.',
        ]);

        Product::create([
            'name' => 'Senar Pancing PE Sougayilang 100m',
            'category' => 'Senar',
            'price' => 95000,
            'stock' => 3, // Menguji status 'Kritis/Menipis' (< 5)
            'description' => 'Senar jalinan (braided) ekstra kuat dengan diameter tipis namun daya tahan gesek tinggi.',
        ]);
    }
}