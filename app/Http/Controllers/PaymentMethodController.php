<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethodRequests\CreatePaymentMethodRequest;
use App\Http\Requests\PaymentMethodRequests\UpdatePaymentMethodRequest;
use App\Http\Resources\PaymentMethodResource;
use App\Services\PaymentMethodService;
use App\Services\Utilities\PaginationValidationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

class PaymentMethodController extends Controller
{
    protected $paymentMethodService;
    protected $paginationValidationService;

    public function __construct(PaymentMethodService $paymentMethodService, PaginationValidationService $paginationValidationService)
    {
        $this->paymentMethodService = $paymentMethodService;
        $this->paginationValidationService = $paginationValidationService;
    }

    public function createPaymentMethod(CreatePaymentMethodRequest $request)
    {
        try {
            $data = $this->paymentMethodService->createPaymentMethod($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Record created successfully.',
                'data' => $data
            ], 201);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function showPaymentMethod($id)
    {
        try {
            $data = $this->paymentMethodService->showPaymentMethod($id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // new PaymentMethodResource($data)
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function listPaymentMethods(Request $request)
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

            $data = $this->paymentMethodService->listPaymentMethods($perPage, $page);

            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // PaymentMethodResource::collection($data)
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

    public function updatePaymentMethod(UpdatePaymentMethodRequest $request, $id)
    {
        try {
            $data = $this->paymentMethodService->updatePaymentMethod($request->validated(), $id);
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

    public function deletePaymentMethod($id)
    {
        try {
            $data = $this->paymentMethodService->deletePaymentMethod($id);
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
