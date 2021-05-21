<?php

namespace Tests\Feature\ResourceTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ProductInvoice;
use Tests\TestCase;

class ProductInvoiceCrudTest extends TestCase
{

    use RefreshDatabase;

    //sample test product
    private $sampleTestProduct = [
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

    //Sample test product 2
    private $secondSampleTestProduct = [
        'id' => 2,
        'product_name' => 'second new product name',
        'product_description' => 'second new product description',
        'product_price' => 223.45,
        'product_sale_price' => 334.45,
        'product_sale_date_start' => '2021-05-07',
        'product_sale_date_end' => '2021-06-07',
        'quantity' => 5,
        'cost' => 22.34
    ];

    //Sample invoice
    private  $singleInvoiceEntry = [
        'id' => 1,
        'customer_id' => 1,
        'total' => 1111.11,
        'paid' => 1
    ];

    /**
     * Creates a sample product for the product invoice to exist
     * 
     * @return void
     */
    private function setUpProduct()
    {
        //Creates a new test product
        $this->post('products/', $this->sampleTestProduct);
    }


    /**
     * Setup for a sample customer
     */
    private function setUpCustomer()
    {
        //Sample test customer
        $sampleCustomer = [
            'id' => 1,
            'first_name' => 'Thomas',
            'last_name' => 'Bockhorn',
            'street_address' => '113 Sweet Hollow Way NW',
            'state' => 'Alabama',
            'zipcode' => '35757',
            'phone_number' => '256.679.6197',
            'email_address' => 'thomas.bockhorn@tecktonet.com'
        ];

        //Sample customer for invoice test then post it 
        $this->post('customer/', $sampleCustomer);
    }

    /**
     * Setup for a sample invoice
     */
    private function setUpInvoice()
    {
        //Single entry for invoices
        $this->post('invoice/', $this->singleInvoiceEntry);
    }


    /**
     * Test to see if the Product Invoice route exists
     * 
     * @return void
     */
    public function test_to_see_if_product_invoice_route_exists()
    {
        $response = $this->get('product_invoice');

        $response->assertStatus(200);
    }

    /**
     * Test to see if product invoice route has 30 entries
     * 
     * @return void
     */
    public function test_to_see_if_product_invoice_has_thirty_entries()
    {
        ProductInvoice::factory(30)->create();

        $this->assertDatabaseCount('product_invoices', 30);
    }

    /**
     * Test to see if a user can retreive a single entry
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_see_a_single_entry()
    {
        //Single product invoice entry
        $singleProductInvoiceEntry = [];

        //Create a random single entry
        $entries = ProductInvoice::factory(1)->create();

        //get data from entry
        foreach ($entries as $entry) {
            $singleProductInvoiceEntry['products_id'] = $entry->products_id;
        }

        //Test to see if its in the database
        $this->assertDatabaseHas('product_invoices', $singleProductInvoiceEntry);
    }

    /**
     * Test to see if a product invoice is added
     * 
     * @return void
     */
    public function test_to_see_if_a_product_invoice_is_added()
    {

        //test sample associative array
        $testSampleDataArray = [
            'products_id' => $this->sampleTestProduct['id'],
            'invoices_id' => $this->singleInvoiceEntry['id']
        ];

        //Setup customer for invoices 
        $this->setUpCustomer();

        //Setup Product
        $this->setUpProduct();

        //Setup Invoice
        $this->setUpInvoice();

        //Add an entry to product invoice
        $this->post('product_invoice/', $testSampleDataArray);

        //Test to see if its in there
        $this->assertDatabaseCount('product_invoices', 1);
        $this->assertDatabaseHas('product_invoices', $testSampleDataArray);
    }

    /**
     * Test to see if user can delete an entry in Product Invoice
     * 
     * @return void
     */
    public function test_to_see_if_user_can_delete_an_entry_in_product_invoice()
    {
        //test sample associative array
        $testSampleDataArray = [
            'products_id' => $this->sampleTestProduct['id'],
            'invoices_id' => $this->singleInvoiceEntry['id']
        ];

        //Delete entry
        $this->delete('product_invoice/1', $testSampleDataArray);

        //Test to see if its in there
        $this->assertDatabaseCount('product_invoices', 0);
        $this->assertDatabaseMissing('product_invoices', $testSampleDataArray);
    }

    /**
     * Test to see if a user can edit the product invoice table
     * 
     * @return void
     */
    public function test_to_see_if_user_can_edit_product_invoice_table()
    {
        //test sample associative array
        $testSampleDataArray = [
            'products_id' => $this->sampleTestProduct['id'],
            'invoices_id' => $this->singleInvoiceEntry['id']
        ];

        //Test sample edited associative array
        $secondSampleTestArray = [
            'products_id' => $this->secondSampleTestProduct['id'],
            'invoices_id' => $this->singleInvoiceEntry['id']
        ];

        //Setup customer for invoices 
        $this->setUpCustomer();

        //Setup Product
        $this->setUpProduct();

        //Setup Invoice
        $this->setUpInvoice();

        //Add an entry to product invoice
        $this->post('product_invoice/', $testSampleDataArray);

        //post the second product entry
        $this->post('product/', $this->secondSampleTestProduct);

        //Now edit the product invoice table to reflect second product
        $this->put('product_invoice/1', $secondSampleTestArray);

        //Test to see if its in there
        $this->assertDatabaseCount('product_invoices', 1);
        $this->assertDatabaseMissing('product_invoices', $secondSampleTestArray);

        //Delete existing entry
        $this->delete('product_invoice/1', $secondSampleTestArray);
    }

    /**
     * Test to see if validation works
     * 
     * @return void
     */
    public function test_to_see_if_validation_works()
    {
        //test sample associative array
        $testWrongSampleDataArray = [
            'products_id' => '1p',
            'invoices_id' => '<p>1</p>'
        ];

        //Setup customer for invoices 
        $this->setUpCustomer();

        //Setup Product
        $this->setUpProduct();

        //Setup Invoice
        $this->setUpInvoice();

        //post wrong sample data
        $this->post('product_invoice/', $testWrongSampleDataArray);

        //Test to see if its in there
        $this->assertDatabaseCount('product_invoices', 1);
        $this->assertDatabaseMissing('product_invoices', $testWrongSampleDataArray);
    }
}