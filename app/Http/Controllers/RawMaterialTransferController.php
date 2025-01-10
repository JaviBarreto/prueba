<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RawMaterialTransferRequests\CreateRawMaterialTransferRequest;
use App\Http\Requests\RawMaterialTransferRequests\UpdateRawMaterialTransferRequest;
use App\Http\Resources\RawMaterialTransferResource;
use App\Services\RawMaterialTransferService;
use App\Services\Utilities\PaginationValidationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

class RawMaterialTransferController extends Controller
{
    protected $rawMaterialTransferService;
    protected $paginationValidationService;

    public function __construct(RawMaterialTransferService $rawMaterialTransferService, PaginationValidationService $paginationValidationService)
    {
        $this->rawMaterialTransferService = $rawMaterialTransferService;
        $this->paginationValidationService = $paginationValidationService;
    }

    public function createRawMaterialTransfer(CreateRawMaterialTransferRequest $request)
    {
        try {
            $data = $this->rawMaterialTransferService->createRawMaterialTransfer($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Record created successfully.',
                'data' => $data
            ], 201);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function showRawMaterialTransfer($id)
    {
        try {
            $data = $this->rawMaterialTransferService->showRawMaterialTransfer($id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // new RawMaterialTransferResource($data)
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

            $data = $this->rawMaterialTransferService->listRawMaterialInventories($perPage, $page);

            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // RawMaterialTransferResource::collection($data)
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

    public function updateRawMaterialTransfer(UpdateRawMaterialTransferRequest $request, $id)
    {
        try {
            $data = $this->rawMaterialTransferService->updateRawMaterialTransfer($request->validated(), $id);
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

    public function deleteRawMaterialTransfer($id)
    {
        try {
            $data = $this->rawMaterialTransferService->deleteRawMaterialTransfer($id);
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
