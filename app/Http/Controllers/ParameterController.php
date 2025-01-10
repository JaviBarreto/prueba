<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParameterRequests\CreateParameterRequest;
use App\Http\Requests\ParameterRequests\UpdateParameterRequest;
use App\Http\Resources\ParameterResource;
use App\Services\ParameterService;
use App\Services\Utilities\PaginationValidationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

class ParameterController extends Controller
{
    protected $parameterService;
    protected $paginationValidationService;

    public function __construct(ParameterService $parameterService, PaginationValidationService $paginationValidationService)
    {
        $this->parameterService = $parameterService;
        $this->paginationValidationService = $paginationValidationService;
    }

    public function createParameter(CreateParameterRequest $request)
    {
        try {
            $data = $this->parameterService->createParameter($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Record created successfully.',
                'data' => $data
            ], 201);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function showParameter($id)
    {
        try {
            $data = $this->parameterService->showParameter($id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // new ParameterResource($data)
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function listParameters(Request $request)
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

            $data = $this->parameterService->listParameters($perPage, $page);

            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    // 'data' => $data
                    ParameterResource::collection($data)
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

    public function updateParameter(UpdateParameterRequest $request, $id)
    {
        try {
            $data = $this->parameterService->updateParameter($request->validated(), $id);
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

    public function deleteParameter($id)
    {
        try {
            $data = $this->parameterService->deleteParameter($id);
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
