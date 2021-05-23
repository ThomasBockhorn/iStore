<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => ucwords($this->faker->words(4, true)),
            'product_description' => $this->faker->paragraph(5),
            'product_price' => $this->faker->randomFloat(2, 1, 5000),
            'product_sale_price' => $this->faker->randomFloat(2, 1, 5000),
            'product_sale_date_start' => $this->faker->dateTimeBetween('now', '+1 year'),
            'product_sale_date_end' => $this->faker->dateTimeBetween('now', '+2 year'),
            'cost' => $this->faker->randomFloat(2, 1, 5000),
            'category' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(0, 10000)
        ];
    }
}