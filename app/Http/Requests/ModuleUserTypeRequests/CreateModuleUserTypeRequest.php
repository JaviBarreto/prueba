<?php

namespace App\Http\Requests\ModuleUserTypeRequests;

use Illuminate\Foundation\Http\FormRequest;

class CreateModuleUserTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'view' => 'required',
            'edit' => 'required',
            'module_id' => 'required',
            'user_type_id' => 'required'
        ];
    }
}
