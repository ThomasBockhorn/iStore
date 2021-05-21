<?php

namespace Tests\Feature\ResourceTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Invoice;

use Tests\TestCase;

class InvoiceCrudTest extends TestCase
{

    use RefreshDatabase;

    //Single entry for invoices
    private $singleInvoiceEntry = [
        'id' => 1,
        'customer_id' => 1,
        'total' => 1111.11,
        'paid' => 1
    ];

    //single updated entry
    private $singleUpdatedInvoiceEntry = [
        'id' => 1,
        'customer_id' => 1,
        'total' => 2222.22,
        'paid' => 1
    ];

    /**
     * Setup for each test to add a customer so that a crud operation can be preformed on an invoice
     */
    private function setUpCustomer()
    {
        //Sample customer for invoice test then post it 
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

        $this->post('customer/', $sampleCustomer);
    }


    /**
     * Test to see if the Invoice route exists
     * 
     * @return void
     */
    public function test_to_see_if_invoice_route_exists()
    {
        $response = $this->get('invoice/');

        $response->assertStatus(200);
    }

    /**
     * Test to see if all the invoices on the route
     * 
     * @return void
     */
    public function test_to_see_if_invoice_shows_all_invoices()
    {
        Invoice::factory(30)->create();

        $this->assertDatabaseCount('invoices', 30);
    }

    /**
     * Test to see if a single invoice can be gathered
     * 
     * @return void
     */
    public function test_to_see_if_a_single_invoice_be_gathered()
    {
        //single invoice
        $singleInvoice = [];

        //Creating one record
        $invoices = Invoice::factory(1)->create();

        //Adding the invoice to the single invoice array
        foreach ($invoices as $invoice) {
            $singleInvoice['customer_id'] = $invoice->customer_id;
        }

        //see if the singleInvoice is in the database
        $this->assertDatabaseHas('invoices', $singleInvoice);
    }

    /**
     * Test to see if an invoice can get added to database
     * 
     * @return void
     */
    public function test_to_see_if_a_single_invoice_can_be_added()
    {

        //Creates sample customer
        $this->setUpCustomer();

        //post the sample invoice based on the customer post
        $this->post('invoice/', $this->singleInvoiceEntry);

        //test to see if your can see it
        $this->assertDatabaseCount('invoices', 1);
        $this->assertDatabaseHas('invoices', $this->singleInvoiceEntry);
    }

    /**
     * Test to see if an invoice can be deleted
     * 
     * @return void
     */
    public function test_to_see_if_an_invoice_can_be_deleted()
    {

        //Creates sample customer
        $this->setUpCustomer();

        //post the sample invoice based on the customer post
        $this->post('invoice/', $this->singleInvoiceEntry);

        //Delete the sample invoice
        $this->delete('invoice/1', $this->singleInvoiceEntry);

        //Test to see if the entry is deleted
        $this->assertDatabaseCount('invoices', 0);
        $this->assertDatabaseMissing('invoices', $this->singleInvoiceEntry);
    }

    /**
     * Test to see if an invoice can be edited
     * 
     * @return void
     */
    public function test_to_see_if_an_invoice_can_be_edited()
    {
        //Sets up customer
        $this->setUpCustomer();

        //post the sample invoice based on the customer post
        $this->post('invoice/', $this->singleInvoiceEntry);

        //update the entry with singleUpdatedInvoiceEntry
        $this->put('/invoice/1', $this->singleUpdatedInvoiceEntry);

        //test to see if your can see it
        $this->assertDatabaseCount('invoices', 1);
        $this->assertDatabaseHas('invoices', $this->singleUpdatedInvoiceEntry);
    }

    /**
     * This test will check to see if the data gets validated in the invoice controller class
     * 
     * @return void
     */
    public function test_to_see_if_validation_works_for_invoice_controller_class()
    {
        //single updated entry
        $singleErrorUpdatedInvoiceEntry = [
            'id' => 1,
            'customer_id' => '1p',
            'total' => '<p>2222.22</p>',
            'paid' => 1
        ];

        //Sets up customer
        $this->setUpCustomer();

        //post the sample invoice based on the customer post
        $this->post('invoice/', $this->singleInvoiceEntry);

        //test to see if your can see it
        $this->assertDatabaseCount('invoices', 1);
        $this->assertDatabaseHas('invoices', $this->singleInvoiceEntry);
    }
}