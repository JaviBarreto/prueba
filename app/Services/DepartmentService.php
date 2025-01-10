<?php

namespace app\Services;

use App\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class DepartmentService
{

    protected $departmentModel;

    public function __construct(Department $departmentModel)
    {
        $this->departmentModel = $departmentModel;
    }

    public function createDepartment($data)
    {
        $department = Department::create([
            'name' => $data['name'],
            // 'user_id' => $data['user_id']
            // 'email' => $data['email'],
        ]);

        return [
            'department' => $department,
        ];
    }

    public function showDepartment($id)
    {
        return Department::find($id);
    }

    public function listDepartments($perPage = 10, $page = 1)
    {
        return Department::with('categories.subCategories')->paginate($perPage, ['*'], 'page', $page);
    }

    public function updateDepartment($data, $id)
    {
        $department = Department::find($id);
        if (!$department) {
            return null;
        }

        if (isset($data['name']) && $data['name'] !== '') {
            $department->name = $data['name'];
        }

        $department->save();

        return $department;
    }

    public function deleteDepartment($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return null;
        }

        $department->delete();

        return $department;
    }
}