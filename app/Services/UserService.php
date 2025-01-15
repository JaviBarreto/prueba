<?php

namespace App\Services;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\Utilities\AuditLogService;

class UserService
{
    protected $userModel;

    public function __construct(User $userModel, AuditLogService $auditLogService)
    {
        $this->userModel = $userModel;
        $this->auditLogService = $auditLogService;
    }

    public function createUser($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_type_id' => $data['user_type_id'],
            'password' => Hash::make($data['password']),
        ]);

        // if (isset($data['addresses'])) {
        //     foreach ($data['addresses'] as $address) {
        //         $user->addresses()->create($data['addresses']);
        //     }
        // }

        // if (isset($data['contacts'])) {
        //     foreach ($data['contacts'] as $address) {
        //         $user->contacts()->create($data['contacts']);
        //     }
        // }

        $token = $user->createToken('Token')->plainTextToken;

        $this->updateTokenExpiration($user->id);

        $this->auditLogService->storeAuditLog($user->id,'create user');

        return [
            // 'user' => $user::with('addresses','contacts')->find($user->id),
            'user' => $user::find($user->id),
            'token' => $token,
        ];
    }

    public function showUser($id)
    {
        return User::find($id);
    }

    public function listUser($perPage = 10, $page = 1)
    {
        return User::paginate($perPage, ['*'], 'page', $page);
    }


    public function updateUser($data, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }

        if (isset($data['name']) && $data['name'] !== '') {
            $user->name = $data['name'];
        }

        if (isset($data['password']) && $data['password'] !== '') {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        $this->auditLogService->storeAuditLog($id,'update user');

        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }

        $user->delete();

        $this->auditLogService->storeAuditLog($id,'delete user');

        return $user;
    }

    protected function updateTokenExpiration($userId)
    {
        $expiresAt = now()->addMinutes(config('sanctum.expiration'));
        DB::table('personal_access_tokens')
            ->where('tokenable_id', $userId)
            ->update(['expires_at' => $expiresAt]);
    }
}
