<?php

namespace App\Http\Controllers;


// use App\Http\Controllers\Controller;
// use App\Http\Requests\PaginationRequest;
// // use App\Http\Requests\PruebaDosRequest;
// use App\Http\Requests\userRequests\PruebaDosRequest;
// use App\Http\Requests\userRequests\CreateUserRequest;
// use App\Http\Requests\userRequests\UpdateUserRequest;
// use App\Models\PersonalAccessToken;
use App\Models\User;
// use App\Models\Usuario;
// use App\Models\UserSession;
// use App\Services\UserService;
// use App\Services\Utilities\PaginationValidationService;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\CreateUserRequest;
use App\Http\Requests\UserRequests\UpdateUserRequest;
use App\Http\Requests\UserRequests\LoginUserRequest;
use App\Services\UserService;
use App\Services\Utilities\PaginationValidationService;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

class UserController extends Controller
{
    protected $userService;
    protected $paginationValidationService;

    public function __construct(UserService $userService, PaginationValidationService $paginationValidationService)
    {
        $this->userService = $userService;
        $this->paginationValidationService = $paginationValidationService;
    }

    public function createUser(CreateUserRequest $request)
    {
        try {
            $data = $this->userService->createUser($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Record created successfully.',
                'data' => $data
            ], 201);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function showUser($id)
    {
        try {
            $data = $this->userService->showUser($id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // 'data' => new UserResource($data)
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function listUsers(Request $request)
    {
        try {
            $validationResult = $this->paginationValidationService->validatePagination($request->all());

            if (isset($validationResult['success']) && !$validationResult['success']) {
                return response()->json([
                    'success' => false,
                    'error' => $validationResult['error'],
                ], 400);
            }

            $perPage = $validationResult['perPage'];
            $page = $validationResult['page'];

            $data = $this->userService->listUser($perPage, $page);

            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // 'data' => UserResource::collection($data)
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Model not found',
                'detail' => $e->getMessage()
            ], 404);
        } catch (NotFoundHttpException $e) {
            return response()->json([
                'message' => 'Page not found.',
            ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function updateUser(UpdateUserRequest $request, $id)
    {
        try {
            $data = $this->userService->updateUser($request->validated(), $id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record updated successfully.',
                    'data' => $data
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function deleteUser($id)
    {
        try {
            $data = $this->userService->deleteUser($id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record deleted successfully.',
                    'data' => $data
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function loginUser(LoginUserRequest $request) {
        
        try {
            
            $data = $this->userService->loginUser($request->validated());
            // return 'sdf';
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'User logged in successfully.',
                    'data' => $data
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }   

    private function handleException(Exception $e)
    {
        return response()->json([
            'success' => false,
            'error' => [
                'message' => 'An error occurred while processing the request.',
                'detail' => $e->getMessage()
            ]
        ], 500);
    }
    
}
