<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{

    protected function commonRules()
    {
        return [
            'common_field' => 'sometimes|required|string|max:255',
        ];
    }

}