<?php

namespace App\Http\Requests\ProductRequests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            // 'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'image' => 'array',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif',
            'image_order' => 'array',
            'image_order.*' => 'nullable|int',
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:8',
            // 'productes' => 'array',
            // 'contacts' => 'array'
        ];
    }

    public function messages()
    {
        return
            [

        ];
    }
}