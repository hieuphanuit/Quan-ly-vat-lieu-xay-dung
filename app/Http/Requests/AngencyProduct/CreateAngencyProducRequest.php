<?php

namespace App\Http\Requests\AngencyProduct;

use Illuminate\Foundation\Http\FormRequest;

class CreateAngencyProducRequest extends FormRequest
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
            'quantity' => 'required|string',
            'product_id' => 'required|string',
            'agency_id' => 'required|string',
        ];
    }
}
