<?php

namespace App\Services;

use App\Models\Module;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ModuleService
{
    protected $moduleModel;

    public function __construct(Module $moduleModel)
    {
        $this->moduleModel = $moduleModel;
    }

    public function createModule($data)
    {
        $module = Module::create([
            'name' => $data['name'],
            'route' => $data['route'],
            'icon' => $data['icon'],
            'status' => $data['status'],
            'department' => $data['department'],
            'position' => $data['position'],
        ]);

        return [
            'module' => $module,
        ];
    }

    public function showModule($id)
    {
        return Module::find($id);
    }

    public function listModules($perPage = 10, $page = 1)
    {
        return Module::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateModule($data, $id)
    {
        $module = Module::find($id);

        if (!$module) {
            return null;
        }

        if (isset($data['name']) && $data['name'] !== '') {
            $module->name = $data['name'];
        }

        if (isset($data['route']) && $data['route'] !== '') {
            $module->route = $data['route'];
        }

        $module->save();

        return $module;
    }

    public function deleteModule($id)
    {
        $module = Module::find($id);
        if (!$module) {
            return null;
        }

        $module->delete();

        return $module;
    }
}
