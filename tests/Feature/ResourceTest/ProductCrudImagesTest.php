<?php

namespace Tests\Feature\ResourceTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ProductImage;
use Tests\TestCase;

class ProductCrudImagesTest extends TestCase
{

    use RefreshDatabase;

    //Sample image url
    protected $sampleURL = [
        'id' => 1,
        'product_id' => 1,
        'image_url' => 'sampleImage.png',
    ];

    //Sample edited image url
    protected $sampleEditedUrl = [
        'id' => 1,
        'product_id' => 1,
        'image_url' => 'sampleNewEditedImage.png'
    ];

    /**
     * Creates a fake product for Produce Image to associate with
     * 
     *@return void
     */
    private function createFakeProduct()
    {
        //Sample test product
        $sampleTestProduct = [
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

        //Creates a new test product
        $this->post('products/', $sampleTestProduct);
    }

    /**
     * Test to see if Product Images route exists
     * 
     * @return void
     */
    public function test_to_see_if_product_images_route_exists()
    {
        $response = $this->get('product_image/');

        $response->assertStatus(200);
    }

    /**
     * Test to see if a user can see 30 image file names
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_see_thirty_file_names()
    {
        ProductImage::factory(30)->create();

        $this->assertDatabaseCount('product_images', 30);
    }

    /**
     * Test to see if a user can retrieve a single image file name
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_see_one_file_name()
    {
        //Array to store the file
        $singleImageFile = [];

        //Create the record in the database
        $productImages = ProductImage::factory(1)->create();

        //Adding the image file to the single image array
        foreach ($productImages as $productImage) {
            $singleImageFile['image_url'] = $productImage->image_url;
        }

        //see if the singleInvoice is in the database
        $this->assertDatabaseHas('product_images', $singleImageFile);
    }

    /**
     * Test to see if a product image can be created
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_add_an_image_url()
    {
        //create product to associate with product image
        $this->createFakeProduct();

        //post sample image url
        $this->post('product_image/', $this->sampleURL);

        //check to see if its in the database
        $this->assertDatabaseCount('product_images', 1);
        $this->assertDatabaseHas('product_images', $this->sampleURL);
    }

    /**
     * Test to see if a product image can be deleted
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_delete_a_image_url()
    {
        //create product to associate with product image
        $this->createFakeProduct();

        //post sample image url
        $this->post('product_image/', $this->sampleURL);

        //Delete image url
        $this->delete('product_image/1', $this->sampleURL);

        //Check to see if it is not there
        $this->assertDatabaseCount('product_images', 0);
        $this->assertDatabaseMissing('product_images', $this->sampleURL);
    }

    /**
     * Test to see if a user can edit an image url
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_edit_a_image_url()
    {
        //create product to associate with product image
        $this->createFakeProduct();

        //post sample image url
        $this->post('product_image/', $this->sampleURL);

        //Edit the sample image url
        $this->put('product_image/1', $this->sampleEditedUrl);

        //Check to see if it is infact edited
        $this->assertDatabaseCount('product_images', 1);
        $this->assertDatabaseHas('product_images', $this->sampleEditedUrl);
    }

    /**
     * Test to see if wrong image inputs are validated
     * 
     * @return void
     */
    public function test_to_see_if_a_wrong_image_inputs_are_validated()
    {
        //Sample image url
        $sampleErrorURL = [
            'id' => 1,
            'product_id' => '1p',
            'image_url' => '<b>sampleImage.png</b>',
        ];

        //create product to associate with product image
        $this->createFakeProduct();

        //post sample image url
        $this->post('product_image/', $sampleErrorURL);

        //Check to see if it is infact edited
        $this->assertDatabaseCount('product_images', 1);
        $this->assertDatabaseHas('product_images', $this->sampleURL);
    }
}