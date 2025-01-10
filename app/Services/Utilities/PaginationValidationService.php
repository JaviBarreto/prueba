<?php

namespace App\Services\Utilities;

use Illuminate\Support\Facades\Validator;

class PaginationValidationService
{

    public function validatePagination(array $data)
    {
        $rules = [
            'perPage' => 'integer|min:1|max:100',
            'page' => 'integer|min:1',
        ];

        if (count($rules) !== count($data)) {
            return [
                'typeError' => 'nuParams',
                'success' => false,
                'error' => [
                    'message' => 'Number of incorrect parameters',
                    'detail' => 'Number of expected parameter(s) ' . count($rules) . ', Number of received parameter(s) ' . count($data),
                ]
            ];
        }

        $invalidParams = array_diff_key($data, $rules);

        if (!empty($invalidParams)) {
            return [
                'typeError' => 'expectedParams',
                'success' => false,
                'error' => [
                    'message' => 'Invalid parameter(s).',
                    'detail' => [
                        'expected parameter(s)' => $rules,
                        'received parameter(s)' => $invalidParams
                    ] ,
                ]
            ];
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return [
                'typeError' => 'validator',
                'success' => false,
                'error' => $validator->errors(),
            ];
        }
        return array_merge(['success' => true], $validator->validated());
    }

}
