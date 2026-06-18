<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'nama_produk' => $this->faker->words(2, true),
        'deskripsi' => $this->faker->sentence(),
        'stok' => $this->faker->numberBetween(5, 50),
        'harga' => $this->faker->numberBetween(10000, 150000),
    ];
}
}
