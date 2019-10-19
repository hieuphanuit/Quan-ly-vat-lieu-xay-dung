<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'string',
            'price' => 'integer',
            'unit' => 'string',
            'categories' => 'array',
            'categories.*' => 'integer|exists:categories,id',
            'images' => 'array',
            'images.*' => 'image'
        ];
    }
}
