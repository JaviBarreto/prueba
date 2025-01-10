<?php

namespace App\Http\Requests\ProductRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the product is authorized to make this request.
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
            'co_producto' => 'required|string|max:255',
            //'email' => 'required|string|email|max:255|unique:users',
            //email' => 'sometimes|required|email|unique:users,email,' . $this->route('user')
           // 'password' => 'required|string|min:8'
        ];
    }

    public function messages()
    {
        return
            [

        ];
    }
}