<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
           // 'addresses' => 'array',
            //'contacts' => 'array',
            'user_type_id' => 'required',
            // 'addresses.*.street' => 'required|string|max:255',
            // 'addresses.*.city' => 'required|string|max:255',
            // 'contacts.*.phone' => 'required|string|max:20',
            // 'contacts.*.email' => 'nullable|email',
        ];
    }

    public function messages()
    {
        return
            [

        ];
    }
}