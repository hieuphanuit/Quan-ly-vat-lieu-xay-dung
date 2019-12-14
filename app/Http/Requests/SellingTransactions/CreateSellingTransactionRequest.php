<?php

namespace App\Http\Requests\SellingTransactions;

use Illuminate\Foundation\Http\FormRequest;

class CreateSellingTransactionRequest extends FormRequest
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
            // 'total_amount' => 'integer|default:null|min:0',
            // 'total_paid' => 'integer|min:0',
         //  'selling_bill_id'   => 'integer|require|min:1',
           // 'amount'    => 'integer|default:null',
        ];
    }
}
