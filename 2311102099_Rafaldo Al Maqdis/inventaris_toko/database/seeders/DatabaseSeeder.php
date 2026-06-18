<?php

namespace Database\Seeders;

use App\Models\Product;
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
        // Buat akun admin default untuk login
        User::create([
            'name'     => 'Pak Cik',
            'email'    => 'admin@toko.com',
            'password' => Hash::make('password123'),
        ]);

        // Buat akun tambahan
        User::create([
            'name'     => 'Mas Aimar',
            'email'    => 'aimar@toko.com',
            'password' => Hash::make('password123'),
        ]);

        // Buat 20 data produk dummy menggunakan factory
        Product::factory()->count(20)->create();

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📧 Login: admin@toko.com | Password: password123');
        $this->command->info('📧 Login: aimar@toko.com | Password: password123');
    }
}
