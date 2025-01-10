<?php

namespace App\Http\Requests\ModuleRequests;

use Illuminate\Foundation\Http\FormRequest;

class CreateModuleRequest extends FormRequest
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
            'name' => 'required',
            'route' => 'required',
            'icon' => 'required',
            'status' => 'required',
            'department' => 'required',
            'position' => 'required',
        ];
    }
}
