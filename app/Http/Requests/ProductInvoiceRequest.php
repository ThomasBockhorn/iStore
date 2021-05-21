<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductInvoiceRequest extends FormRequest
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
            'products_id' => 'numeric|integer|nullable',
            'invoices_id' => 'numeric|integer|nullable'
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
            'products_id' => filter_var($this->products_id, FILTER_SANITIZE_NUMBER_INT),
            'invoices_id' => filter_var($this->invoices_id,  FILTER_SANITIZE_NUMBER_INT),
        ]);
    }
}