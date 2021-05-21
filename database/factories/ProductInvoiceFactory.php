<?php

namespace Database\Factories;

use App\Models\ProductInvoice;
use App\Models\Product;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductInvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductInvoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'products_id' => Product::factory(),
            'invoices_id' => Invoice::factory()
        ];
    }
}