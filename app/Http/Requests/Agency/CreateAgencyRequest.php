<?php

namespace App\Http\Requests\Agency;

use Illuminate\Foundation\Http\FormRequest;

class CreateAgencyRequest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            // 'categories' => 'required|array',
            // 'categories.*' => 'required|integer|exists:categories,id',
            // 'images' => 'array',
            // 'images.*' => 'image'
        ];
    }
}
