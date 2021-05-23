<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|string',
            'product_description' => 'required',
            'product_price' => 'required|numeric',
            'product_sale_price' => 'numeric',
            'product_sale_date_start' => 'date',
            'product_sale_date_end' => 'date',
            'quantity' => 'required|integer|numeric',
            'category' => 'required|string',
            'cost' => 'required|numeric'
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
            'product_name' => filter_var($this->product_name, FILTER_SANITIZE_STRING),
            'product_description' => filter_var($this->product_description, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'product_price' => filter_var($this->product_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'product_sale_price' => filter_var($this->product_sale_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'quantity' => filter_var($this->quantity, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'category' => filter_var($this->category, FILTER_SANITIZE_STRING),
            'cost' => filter_var($this->cost, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
        ]);
    }
}