<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Customer;
use Tests\TestCase;

class CustomerCrudTest extends TestCase
{

    use RefreshDatabase;

    //initial test single customer entry
    private $singleCustomer = [
        'id' => 1,
        'first_name' => 'Thomas',
        'last_name' => 'Bockhorn',
        'street_address' => '113 Sweet Hollow Way NW',
        'state' => 'Alabama',
        'zipcode' => '35757',
        'phone_number' => '256.679.6197',
        'email_address' => 'thomas.bockhorn@tecktonet.com'
    ];

    //updated test single customer entry
    private $updatedSingleCustomer = [
        'id' => 1,
        'first_name' => 'Edward',
        'last_name' => 'Smith',
        'street_address' => '113 Sweet Hollow Way NW',
        'state' => 'Alabama',
        'zipcode' => '35757',
        'phone_number' => '256.679.6197',
        'email_address' => 'thomas.bockhorn@tecktonet.com'
    ];

    /**
     * This test to see if the customer resource route exists
     *
     * @return void
     */
    public function test_customer_resource_route()
    {
        $response = $this->get('/customer');

        $response->assertStatus(200);
    }

    /**
     * A test to see if a user can see all the customers
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_read_customer_entries()
    {
        Customer::factory(30)->create();

        $this->assertDatabaseCount('customers', 30);
    }

    /**
     * A test to see if the user can see one customer
     * 
     * @return void
     */
    public function test_to_see_if_a_user_see_one_customer_first_name_entry()
    {
        //single record customer array
        $pickedCustomer = [];

        //create a customer record for the database
        $customers = Customer::factory(1)->create();

        //Adding it to the customer array
        foreach ($customers as $customer) {
            $pickedCustomer['first_name'] = $customer->first_name;
        };

        $this->assertDatabaseHas('customers', $pickedCustomer);
    }

    /**
     * A test to see if the user can add a customer
     * 
     * @return void
     */
    public function test_to_see_if_a_customer_can_add_a_customer_to_the_database()
    {

        //post the sample customer
        $this->post('/customer', $this->singleCustomer);

        //check if its in there
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseHas('customers', $this->singleCustomer);
    }

    /**
     * A test to see if a customer entry can be deleted
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_delete_a_customer_entry()
    {

        //post the sample customer
        $this->post('/customer', $this->singleCustomer);

        //delete entry
        $this->delete('/customer/1', $this->singleCustomer);

        //check if its in there
        $this->assertDatabaseCount('customers', 0);
        $this->assertDatabaseMissing('customers', $this->singleCustomer);
    }

    /**
     * A test to see if a user can edit a customer entry
     * 
     * @return void
     */
    public function test_to_see_if_a_user_can_edit_a_customer_entry()
    {

        //post the sample customer
        $this->post('/customer', $this->singleCustomer);

        //update the sample customer entry
        $this->put('/customer/1', $this->updatedSingleCustomer);

        //check if its in there
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseHas('customers', $this->updatedSingleCustomer);
    }

    /**
     * This test will test the validation of the customer controller class
     * 
     * @return void
     */
    public function test_to_see_if_customer_validation_works_when_adding_a_customer_to_the_database()
    {

        //post the sample customer
        $response = $this->post('/customer', $this->singleCustomer);

        //Check to see if there are not validation errors
        $response->assertSessionHasNoErrors();
    }

    /**
     * This test will check if the validation works for editing a customer entry
     * 
     * @return void
     */
    public function test_to_see_if_a_customer_validation_works_when_editing_a_customer_entry()
    {

        //post the sample customer
        $this->post('/customer', $this->singleCustomer);

        //update the sample customer entry
        $response = $this->put('/customer/1', $this->updatedSingleCustomer);

        //Check to see if there are not validation errors
        $response->assertSessionHasNoErrors();
    }

    /**
     * This test will check to see if harmful entries are stripped away before validation
     * 
     * @return void
     */
    public function test_to_see_if_harmful_entries_are_sanitized_before_validation()
    {
        //initial test harmful single customer entry
        $harmfulSingleCustomerEntry = [
            'id' => 1,
            'first_name' => '<p>Thomas</p>',
            'last_name' => 'Bockhorn',
            'street_address' => '113 Sweet Hollow Way NW',
            'state' => 'Alabama',
            'zipcode' => '35757',
            'phone_number' => '256.679.6197',
            'email_address' => 'thomas.bockhorn@tecktonet.com'
        ];

        //post the harmful sample customer entry
        $this->post('/customer', $harmfulSingleCustomerEntry);

        //check if its is santizied
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseHas('customers', $this->singleCustomer);
    }
}