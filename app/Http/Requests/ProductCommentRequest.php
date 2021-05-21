<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCommentRequest extends FormRequest
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
            'first_name' => 'required|string|max:255|alpha',
            'last_name' => 'required|string|max:255|alpha',
            'comment' => 'required',
            'stars' => 'required|integer|numeric'
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
            'first_name' => filter_var($this->first_name, FILTER_SANITIZE_STRING),
            'last_name' => filter_var($this->last_name, FILTER_SANITIZE_STRING),
            'comment' => filter_var($this->comment, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'stars' => filter_var($this->stars, FILTER_SANITIZE_NUMBER_INT)
        ]);
    }
}