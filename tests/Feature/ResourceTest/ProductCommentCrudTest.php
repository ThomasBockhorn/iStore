<?php

namespace Tests\Feature\ResourceTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ProductComment;
use Tests\TestCase;

class ProductCommentCrudTest extends TestCase
{

    use RefreshDatabase;

    //Sample product comment
    protected $sampleProductComment = [
        'id' => 1,
        'product_id' => 1,
        'first_name' => 'Thomas',
        'last_name' => 'Bockhorn',
        'comment' => 'Lorem Ipsem Lorem Ipsem',
        'stars' => 5
    ];

    //Sample updated product comment
    protected $sampleUpdatedProductComment = [
        'id' => 1,
        'product_id' => 1,
        'first_name' => 'Thomas',
        'last_name' => 'Bockhorn',
        'comment' => 'My new updated comment',
        'stars' => 2
    ];

    /**
     * Creates a sample product for the comment to exist
     * 
     * @return void
     */
    private function sampleProductCreation()
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
            'cost' => 12.34
        ];

        //Creates a new test product
        $this->post('products/', $sampleTestProduct);
    }

    /**
     * Test to see if ProductComment route exists
     * 
     * @return void
     */
    public function test_to_see_if_product_comment_route_works()
    {
        $response = $this->get('product_comment/');

        $response->assertStatus(200);
    }

    /**
     * Test to see if a user can see all the product comments
     * 
     * @return void
     */
    public function test_to_see_if_user_can_see_all_the_product_comments()
    {

        ProductComment::factory(30)->create();

        $this->assertDatabaseCount('product_comments', 30);
    }

    /**
     * Test to see if a single comment can be retreived
     * 
     * @return void
     */
    public function test_to_see_if_a_single_comment_can_be_retreived()
    {
        //single invoice
        $singleProductComment = [];

        //Creating one record
        $productComments = ProductComment::factory(1)->create();

        //Adding the invoice to the single invoice array
        foreach ($productComments as $productComment) {
            $singleProductComment['first_name'] = $productComment->first_name;
        }

        //see if the singleInvoice is in the database
        $this->assertDatabaseHas('product_comments', $singleProductComment);
    }

    /**
     * Test to see if a user can add an comment
     * 
     * @return void
     */
    public function test_to_see_if_user_can_add_invoice()
    {
        //Create an instance of a product to add a reference to comment
        $this->sampleProductCreation();

        //Post the sample Product comment
        $this->post('product_comment/', $this->sampleProductComment);

        //Test to see if its there
        $this->assertDatabaseCount('product_comments', 1);
        $this->assertDatabaseHas('product_comments', $this->sampleProductComment);
    }

    /**
     * Test to see if a user can delete a comment 
     * 
     * @return void
     */
    public function test_to_see_if_user_can_delete_comment()
    {
        //Create an instance of a product to add a reference to comment
        $this->sampleProductCreation();

        //Post the sample Product comment
        $this->post('product_comment/', $this->sampleProductComment);

        //Now we delete the comment
        $this->delete('product_comment/1', $this->sampleProductComment);

        //Test to see if its not there
        $this->assertDatabaseCount('product_comments', 0);
        $this->assertDatabaseMissing('product_comments', $this->sampleProductComment);
    }

    /**
     * Test to see if a user can edit a product comment
     * 
     * @return void
     */
    public function test_to_see_if_user_can_edit_a_comment()
    {
        //Create an instance of a product to add a reference to comment
        $this->sampleProductCreation();

        //Post the sample Product comment
        $this->post('product_comment/', $this->sampleProductComment);

        //Update the sample product comment
        $this->put('product_comment/1', $this->sampleUpdatedProductComment);

        //Test to see if the update is there
        $this->assertDatabaseCount('product_comments', 1);
        $this->assertDatabaseHas('product_comments', $this->sampleUpdatedProductComment);
    }

    /**
     * Test to see if the product comment validation works
     * 
     * @return void
     */
    public function test_to_see_if_product_comment_validation_works()
    {
        //Sample updated product error comment
        $sampleWrongProductComment = [
            'id' => 1,
            'product_id' => '1<p>',
            'first_name' => '<b>Thomas</b>',
            'last_name' => '<b>Bockhorn</b>',
            'comment' => 'Lorem Ipsem Lorem Ipsem',
            'stars' => 5
        ];

        //Create an instance of a product to add a reference to comment
        $this->sampleProductCreation();

        //Post the sample Product comment
        $this->post('product_comment/', $sampleWrongProductComment);

        //Test to see if the update is there
        $this->assertDatabaseCount('product_comments', 1);
        $this->assertDatabaseHas('product_comments', $this->sampleProductComment);
    }
}