<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:products,name,' . $this->id],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string'],
            'image_url' => ['nullable', 'string']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.unique' => 'O nome já está em uso.',
            'price.required' => 'O campo preço é obrigatório.',
            'price.numeric' => 'O campo preço deve ser um número.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.string' => 'O campo descrição deve ser uma string.',
            'category.required' => 'O campo categoria é obrigatório.',
            'category.string' => 'O campo categoria deve ser uma string.',
            'image_url.string' => 'A URL da imagem deve ser uma string.'
        ];
    }
}
