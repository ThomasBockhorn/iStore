<?php

namespace Tests\Feature\ResourceTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    //Sample test product
    private $sampleTestProduct = [
        'id' => 1,
        'product_name' => 'new product name',
        'product_description' => 'new product description',
        'product_price' => 123.45,
        'product_sale_price' => 234.45,
        'product_sale_date_start' => '2021-05-07',
        'product_sale_date_end' => '2021-06-07',
        'quantity' => 5,
        'category' => 'category',
        'cost' => 12.34
    ];

    //Sample test product
    private $sampleSecondTestProduct = [
        'id' => 1,
        'product_name' => 'new new product name',
        'product_description' => 'new new product description',
        'product_price' => 123.45,
        'product_sale_price' => 234.45,
        'product_sale_date_start' => '2021-05-07',
        'product_sale_date_end' => '2021-06-07',
        'quantity' => 5,
        'category' => 'nCategory',
        'cost' => 12.34
    ];

    /**
     * Test to see if Product route works
     * 
     * @return void
     */
    public function test_to_see_if_product_route_exists()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    /**
     * Test to see if all the products can be seen
     * 
     * @return void
     */
    public function test_to_see_if_all_products_are_seen()
    {
        Product::factory(30)->create();

        $this->assertDatabaseCount('products', 30);
    }

    /**
     * Test to see if a user can see one product
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_see_one_product()
    {
        //single record customer array
        $pickedProduct = [];

        //create a customer record for the database
        $products = Product::factory(1)->create();

        //Adding it to the customer array
        foreach ($products as $product) {
            $pickedProduct['product_name'] = $product->product_name;
        };

        $this->assertDatabaseHas('products', $pickedProduct);
    }

    /**
     * Test to see if a user can add a product
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_add_a_product()
    {
        //post the sample product
        $this->post('/products', $this->sampleTestProduct);

        //check if its in there
        $this->assertDatabaseCount('products', 1);

        $this->assertDatabaseHas('products', $this->sampleTestProduct);
    }

    /**
     * Test to see if a user can delete a product
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_delete_a_product()
    {
        //post the sample product
        $this->post('/products', $this->sampleTestProduct);

        //delete entry
        $this->delete('/products/1', $this->sampleTestProduct);

        //check if its in there
        $this->assertDatabaseCount('products', 0);

        $this->assertDatabaseMissing('products', $this->sampleTestProduct);
    }

    /**
     * Test to see if a user can edit a product item
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_update_a_product()
    {
        //post the sample product
        $this->post('/products', $this->sampleTestProduct);

        //update the sample product entry
        $this->put('/products/1', $this->sampleSecondTestProduct);

        //check if its in there
        $this->assertDatabaseCount('products', 1);

        $this->assertDatabaseHas('products', $this->sampleSecondTestProduct);
    }

    /**
     * Test to see if the validation works for the product controller
     * 
     * @return void
     */
    public function test_to_see_if_the_validation_works_for_product_controller()
    {
        //post the sample customer
        $this->post('/products', $this->sampleTestProduct);

        //update the sample customer entry
        $response = $this->put('/products/1', $this->sampleSecondTestProduct);

        //Check to see if there are not validation errors
        $response->assertSessionHasNoErrors();
    }
}