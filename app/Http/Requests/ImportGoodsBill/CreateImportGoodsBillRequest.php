<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateImportGoodsBillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'total_amount' => 'integer|default:null|min:0',
            'total_paid' => 'integer|min:0',
            'vendor_id'   => 'integer|require|min:0',
            'status'    => 'integer|default:null'
        ];
    }
}
