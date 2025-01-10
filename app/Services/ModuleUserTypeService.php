<?php

namespace App\Services;

use App\Models\ModuleUserType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ModuleUserTypeService
{
    protected $moduleUserTypeModel;

    public function __construct(ModuleUserType $moduleUserTypeModel)
    {
        $this->moduleUserTypeModel = $moduleUserTypeModel;
    }

    public function createModuleUserType($data)
    {
        $moduleUserType = ModuleUserType::create([
            'view' => $data['view'],
            'edit' => $data['edit'],
            'module_id' => $data['module_id'],
            'user_type_id' => $data['user_type_id'],
        ]);

        return [
            'moduleUserType' => $moduleUserType,
        ];
    }

    public function showModuleUserType($id)
    {
        return ModuleUserType::find($id);
    }

    public function listModuleUserTypes($perPage = 10, $page = 1)
    {
        return ModuleUserType::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateModuleUserType($data, $id)
    {
        $moduleUserType = ModuleUserType::find($id);

        if (!$moduleUserType) {
            return null;
        }

        if (isset($data['view']) && $data['view'] !== '') {
            $moduleUserType->view = $data['view'];
        }

        if (isset($data['edit']) && $data['edit'] !== '') {
            $moduleUserType->edit = $data['edit'];
        }

        if (isset($data['module_id']) && $data['module_id'] !== '') {
            $moduleUserType->module_id = $data['module_id'];
        }

        if (isset($data['user_type_id']) && $data['user_type_id'] !== '') {
            $moduleUserType->user_type_id = $data['user_type_id'];
        }

        $moduleUserType->save();

        return $moduleUserType;
    }

    public function deleteModuleUserType($id)
    {
        $moduleUserType = ModuleUserType::find($id);
        if (!$moduleUserType) {
            return null;
        }

        $moduleUserType->delete();

        return $moduleUserType;
    }
}
