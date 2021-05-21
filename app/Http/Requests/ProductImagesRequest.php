<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImagesRequest extends FormRequest
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
            'product_id' => 'required|integer|numeric',
            'image_url' => 'required|string'
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
            'product_id' => filter_var($this->product_id, FILTER_SANITIZE_NUMBER_INT),
            'image_url' => filter_var($this->image_url,  FILTER_SANITIZE_STRING),
        ]);
    }
}