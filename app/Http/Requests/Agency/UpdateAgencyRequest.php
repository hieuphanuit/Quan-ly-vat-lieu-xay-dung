<?php

namespace App\Http\Requests\Agency;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgencyRequest extends FormRequest
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
            'address' => 'string',
            'phone' => 'required|string|max:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không có tên đại lý!',
            'phone.max'  => 'Số Điện thoại không đúng!',
        ];
    }
}
