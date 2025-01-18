<?php

namespace App\Services;

use App\Models\UserType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class UserTypeService
{
    protected $userTypeModel;

    public function __construct(UserType $userTypeModel)
    {
        $this->userTypeModel = $userTypeModel;
    }

    public function createUserType($data)
    {
        $userType = UserType::create([
            'name' => $data['name'],
            'status' => $data['status']
        ]);

        return [
            'userType' => $userType,
        ];
    }

    public function showUserType($id)
    {
        return UserType::with(['modules'])->find($id);
    }

    public function listUserTypes($perPage = 10, $page = 1)
    {
        return UserType::with(['modules'])->paginate($perPage, ['*'], 'page', $page);
    }

    public function updateUserType($data, $id)
    {
        $userType = UserType::find($id);

        if (!$userType) {
            return null;
        }

        if (isset($data['name']) && $data['name'] !== '') {
            $userType->name = $data['name'];
        }

        if (isset($data['status']) && $data['status'] !== '') {
            $userType->status = $data['status'];
        }

        $userType->save();

        return $userType;
    }

    public function deleteUserType($id)
    {
        $userType = UserType::find($id);
        if (!$userType) {
            return null;
        }

        $userType->delete();

        return $userType;
    }
}
