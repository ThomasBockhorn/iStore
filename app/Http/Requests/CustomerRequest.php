<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PhoneNumber;

class CustomerRequest extends FormRequest
{

    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255|string|alpha',
            'last_name' => 'required|max:255|string|alpha',
            'street_address' => 'required|string|max:255',
            'state' => 'required|string|max:255|alpha',
            'zipcode' => 'required|string|alpha_num',
            'phone_number' => ['required', new PhoneNumber],   //initializes new phone number format rule
            'email_address' => 'required|email'

        ];
    }

    /**
     * Prepare the data for validation to prevent errors before getting validated
     * 
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'first_name' => filter_var($this->first_name, FILTER_SANITIZE_STRING),
            'last_name' => filter_var($this->last_name, FILTER_SANITIZE_STRING),
            'street_address' => filter_var($this->street_address, FILTER_SANITIZE_STRING),
            'state' => filter_var($this->state, FILTER_SANITIZE_STRING),
            'zipcode' => filter_var($this->zipcode, FILTER_SANITIZE_STRING),
            'email_address' => filter_var($this->email_address, FILTER_SANITIZE_EMAIL),
            'phone_number' => filter_var($this->phone_number, FILTER_SANITIZE_STRING)
        ]);
    }
}