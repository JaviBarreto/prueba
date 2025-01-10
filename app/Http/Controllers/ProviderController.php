<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderRequests\CreateProviderRequest;
use App\Http\Requests\ProviderRequests\UpdateProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Services\ProviderService;
use App\Services\Utilities\PaginationValidationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

class ProviderController extends Controller
{
    protected $providerService;
    protected $paginationValidationService;

    public function __construct(ProviderService $providerService, PaginationValidationService $paginationValidationService)
    {
        $this->providerService = $providerService;
        $this->paginationValidationService = $paginationValidationService;
    }

    public function createProvider(CreateProviderRequest $request)
    {
        try {
            $data = $this->providerService->createProvider($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Record created successfully.',
                'data' => $data
                // new ProviderResource($data)
            ], 201);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function showProvider($id)
    {
        try {
            $data = $this->providerService->showProvider($id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // ProviderResource::collection($data)
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function listProviders(Request $request)
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

            $data = $this->providerService->listProviders($perPage, $page);

            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
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

    public function updateProvider(UpdateProviderRequest $request, $id)
    {
        try {
            $data = $this->providerService->updateProvider($request->validated(), $id);
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

    public function deleteProvider($id)
    {
        try {
            $data = $this->providerService->deleteProvider($id);
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
