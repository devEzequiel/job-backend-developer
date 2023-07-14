<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class FilterProductRequest extends FormRequest
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
            'search' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'exists:products,category'],
            'with_image' => ['nullable', 'boolean'],
            'product_id' => ['nullable', 'number', 'exists:products,id']
        ];
    }
}
