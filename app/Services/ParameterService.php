<?php

namespace App\Services;

use App\Models\Parameter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ParameterService
{
    protected $parameterModel;

    public function __construct(Parameter $parameterModel)
    {
        $this->parameterModel = $parameterModel;
    }

    public function createParameter($data)
    {
        $parameter = Parameter::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'parameter' => $parameter,
        ];
    }

    public function showParameter($id)
    {
        return Parameter::where('user_id', $id)->get();
    }

    public function listParameters($perPage = 10, $page = 1)
    {
        return Parameter::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateParameter($data, $id)
    {
        $parameter = Parameter::find($id);

        if (!$parameter) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $parameter->co = $data['co'];
        }

        $parameter->save();

        return $parameter;
    }

    public function deleteParameter($id)
    {
        $parameter = Parameter::find($id);
        if (!$parameter) {
            return null;
        }

        $parameter->delete();

        return $parameter;
    }
}
