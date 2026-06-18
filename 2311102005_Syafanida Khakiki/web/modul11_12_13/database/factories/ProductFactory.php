<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Smartphone', 'Laptop', 'Audio', 'Aksesoris', 'Smart Home'];
        $names = [
            'Smartphone Aurora X1', 'Laptop UltraSlim 14', 'Earbuds SoundWave Pro',
            'Kabel Data TypeC Fast', 'Smart Bulb ColorMax', 'Power Bank 20000mAh',
            'Mouse Wireless ErgoFit', 'Keyboard Mechanical RGB', 'Speaker Bluetooth Boom',
            'CCTV SmartView 360'
        ];

        return [
            'name'     => $this->faker->randomElement($names) . ' ' . $this->faker->bothify('##??'),
            'category' => $this->faker->randomElement($categories),
            'price'    => $this->faker->numberBetween(75000, 8500000),
            'stock'    => $this->faker->numberBetween(0, 100),
        ];
    }
}
