<?php

namespace App\Http\Requests\CategoryRequests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the category is authorized to make this request.
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
            'department_id' => 'required|int',
            'name' => 'required|string|max:255'
            // 'addresses.*.street' => 'required|string|max:255',
            // 'addresses.*.city' => 'required|string|max:255',
            // 'categories.*.phone' => 'required|string|max:20',
            // 'categories.*.email' => 'nullable|email',
        ];
    }

    public function messages()
    {
        return
            [

        ];
    }
}