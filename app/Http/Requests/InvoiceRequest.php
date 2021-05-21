<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
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
            'customer_id' => 'required|integer|numeric',
            'total' => 'required|numeric',
            'paid' => 'required|boolean'
        ];
    }

    /**
     * Filter the data before validation
     * 
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'customer_id' => filter_var($this->customer_id, FILTER_SANITIZE_NUMBER_INT),
            'total' => filter_var($this->total,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'paid' => filter_var($this->paid, FILTER_SANITIZE_NUMBER_INT)
        ]);
    }
}