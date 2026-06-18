<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        // Daftar kategori acak
        $kategori = ['Elektronik', 'Pakaian', 'Makanan', 'Minuman', 'Aksesoris', 'Furnitur'];

        return [
            // Membuat SKU acak seperti SKU-2026-X8A9
            'kode_barang' => 'SKU-' . date('Y') . '-' . strtoupper(Str::random(4)),
            
            // Membuat nama produk acak (terdiri dari 2-3 kata)
            'nama_produk' => ucwords($this->faker->words($this->faker->numberBetween(2, 3), true)),
            
            // Mengambil kategori secara acak dari array di atas
            'kategori'    => $this->faker->randomElement($kategori),
            
            // Stok acak antara 0 sampai 150
            'stok'        => $this->faker->numberBetween(0, 150),
            
            // Harga acak antara Rp 10.000 sampai Rp 5.000.000
            'harga'       => $this->faker->numberBetween(10, 5000) * 1000, 
        ];
    }
}