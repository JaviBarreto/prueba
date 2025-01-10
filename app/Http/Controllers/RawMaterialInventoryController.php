<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RawMaterialInventoryRequests\CreateRawMaterialInventoryRequest;
use App\Http\Requests\RawMaterialInventoryRequests\UpdateRawMaterialInventoryRequest;
use App\Http\Resources\RawMaterialInventoryResource;
use App\Services\RawMaterialInventoryService;
use App\Services\Utilities\PaginationValidationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

class RawMaterialInventoryController extends Controller
{
    protected $rawMaterialInventoryService;
    protected $paginationValidationService;

    public function __construct(RawMaterialInventoryService $rawMaterialInventoryService, PaginationValidationService $paginationValidationService)
    {
        $this->rawMaterialInventoryService = $rawMaterialInventoryService;
        $this->paginationValidationService = $paginationValidationService;
    }

    public function createRawMaterialInventory(CreateRawMaterialInventoryRequest $request)
    {
        try {
            $data = $this->rawMaterialInventoryService->createRawMaterialInventory($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Record created successfully.',
                'data' => $data
            ], 201);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function showRawMaterialInventory($id)
    {
        try {
            $data = $this->rawMaterialInventoryService->showRawMaterialInventory($id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // new RawMaterialInventoryResource($data)
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function listRawMaterialInventories(Request $request)
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

            $data = $this->rawMaterialInventoryService->listRawMaterialInventories($perPage, $page);

            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // RawMaterialInventoryResource::collection($data)
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

    public function updateRawMaterialInventory(UpdateRawMaterialInventoryRequest $request, $id)
    {
        try {
            $data = $this->rawMaterialInventoryService->updateRawMaterialInventory($request->validated(), $id);
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

    public function deleteRawMaterialInventory($id)
    {
        try {
            $data = $this->rawMaterialInventoryService->deleteRawMaterialInventory($id);
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
