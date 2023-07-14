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
            'category' => ['nullable', 'string'],
            'with_image' => ['nullable', 'boolean'],
            'product_id' => ['nullable', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'search.string' => 'O campo de pesquisa deve ser uma string.',
            'category.string' => 'O campo de categoria deve ser uma string.',
            'category.exists' => 'A categoria selecionada não existe.',
            'with_image.boolean' => 'O campo com imagem deve ser um boolean.',
            'product_id.numeric' => 'O ID do produto deve ser um número.',
            'product_id.exists' => 'O ID do produto selecionado não existe.'
        ];
    }
}
