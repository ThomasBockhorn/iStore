<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductInvoice;
use App\Models\ProductImage;
use App\Models\ProductComment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ProductImage::factory(30)->create();
        ProductComment::factory(30)->create();
        ProductInvoice::factory(30)->create();
    }
}