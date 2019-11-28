<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $user = auth()->user();
        $validRole = (string)UserRolesStatic::BUSINESS_STAFF . ',' .
            (string)UserRolesStatic::WAREHOUSE_STAFF;

        if($user->role == UserRolesStatic::ASSISTANT){
            $validRole = ',' .(string)UserRolesStatic::AGENCY_MANAGER;
        }
        if($user->role == UserRolesStatic::ASSISTANT){
            
        }

        return [
            'email' => 'required|email',
            'name' => 'required|string',
            'password' => 'required|string',
            'phone' => 'required|string',
            'role' => 'required|in:'.$validRole,
        ];

    }
}
