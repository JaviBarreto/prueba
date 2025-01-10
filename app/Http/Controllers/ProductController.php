<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequests\CreateProductRequest;
use App\Http\Requests\ProductRequests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\productService;
use App\Services\Utilities\ImageService;
use App\Services\Utilities\PaginationValidationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProductController extends Controller
{
    protected $imageService;
    protected $paginationValidationService;
    protected $productService;

    public function __construct(ImageService $imageService, PaginationValidationService $paginationValidationService, ProductService $productService)
    {
        $this->imageService = $imageService;
        $this->paginationValidationService = $paginationValidationService;
        $this->productService = $productService;
    }

    public function createProduct(CreateProductRequest $request)
    {
        try {
            $data = $this->productService->createProduct($request->validated(), $request->file('image'));

            return response()->json([
                'success' => true,
                'message' => 'Record created successfully.',
                'data' => $data
                // new ProductResource($data)
            ], 201);
        } catch (Exception $e) {

            // foreach ($uploadedImages as $path) {
            //     $this->imageService->deleteImage($ipath);
            // }

            return $this->handleException($e);
        }
    }

    public function showProduct($id)
    {
        try {
            $data = $this->productService->showProduct($id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // ProductResource::collection($data)
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function listProducts(Request $request)
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

            $data = $this->productService->listProducts($perPage, $page);

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

    public function updateProduct(UpdateProductRequest $request, $id)
    {
        try {
            $data = $this->productService->updateProduct($request->validated(), $id);
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

    public function deleteProduct($id)
    {
        try {
            $data = $this->productService->deleteProduct($id);
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
