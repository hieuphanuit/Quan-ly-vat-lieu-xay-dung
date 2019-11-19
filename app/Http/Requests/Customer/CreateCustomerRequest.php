<?php


namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;


class CreateCustomerRequest extends FormRequest
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
            'email' => 'email|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'string|min:10',
            'in_debt_amount' => 'integer'
        ];
    }
}
