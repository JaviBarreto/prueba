<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequests\CreateCategoryRequest;
use App\Http\Requests\CategoryRequests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use App\Services\Utilities\PaginationValidationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $paginationValidationService;

    public function __construct(CategoryService $categoryService, PaginationValidationService $paginationValidationService)
    {
        $this->categoryService = $categoryService;
        $this->paginationValidationService = $paginationValidationService;
    }

    public function createCategory(CreateCategoryRequest $request)
    {
        try {
            $data = $this->categoryService->createCategory($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Record created successfully.',
                'data' => $data
            ], 201);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function showCategory($id)
    {
        try {
            $data = $this->categoryService->showCategory($id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // new CategoryResource($data)
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function listCategories(Request $request)
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

            $data = $this->categoryService->listCategories($perPage, $page);

            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                    // CategoryResource::collection($data)
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

    public function updateCategory(UpdateCategoryRequest $request, $id)
    {
        try {
            $data = $this->categoryService->updateCategory($request->validated(), $id);
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

    public function deleteCategory($id)
    {
        try {
            $data = $this->categoryService->deleteCategory($id);
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
