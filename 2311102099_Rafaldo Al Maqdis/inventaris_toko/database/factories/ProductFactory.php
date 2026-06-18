<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            'Beras Premium 5kg', 'Minyak Goreng 2L', 'Gula Pasir 1kg',
            'Tepung Terigu 1kg', 'Kopi Instan 200g', 'Teh Celup isi 25',
            'Susu Full Cream 1L', 'Mie Instan Goreng', 'Sarden Kaleng 425g',
            'Kecap Manis 600ml', 'Sambal Botol 340g', 'Mayonaise 250ml',
            'Sabun Cuci Piring 500ml', 'Deterjen Bubuk 1kg', 'Shampo 170ml',
            'Sabun Mandi Batang', 'Pasta Gigi 120g', 'Tisu Wajah isi 200',
            'Minyak Kayu Putih 60ml', 'Obat Nyamuk Bakar isi 10',
            'Snack Keripik Singkong 200g', 'Biskuit Crackers 250g',
            'Minuman Soda 1.5L', 'Air Mineral 1.5L', 'Jus Buah Kotak 200ml',
        ];

        return [
            'name'        => $this->faker->unique()->randomElement($products),
            'stock'       => $this->faker->numberBetween(5, 200),
            'price'       => $this->faker->randomElement([
                1500, 2000, 2500, 3000, 3500, 4000, 5000, 6000, 7000, 7500,
                8000, 9000, 10000, 12000, 15000, 18000, 20000, 25000, 30000, 35000,
            ]),
            'description' => $this->faker->optional(0.7)->sentence(10),
        ];
    }
}
