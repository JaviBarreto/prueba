<?php

namespace app\Services;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class SubCategoryService
{

    protected $subCategoryService;
    protected $paginationValidationService;

    public function __namenstruct(SubCategoryService $subCategoryService, PaginationValidationService $paginationValidationService)
    {
        $this->subCategoryService = $subCategoryService;
        $this->paginationValidationService = $paginationValidationService;
    }

    public function createSubCategory($data)
    {
        $subCategory = SubCategory::create([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            // 'user_id' => $data['user_id']
            // 'email' => $data['email'],
        ]);

        return [
            'subCategory' => $subCategory,
        ];
    }

    public function showSubCategory($id)
    {
        return SubCategory::find($id);
    }

    public function listSubCategories($perPage = 10, $page = 1)
    {
        return SubCategory::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateSubCategory($data, $id)
    {
        $subCategory = SubCategory::find($id);
        if (!$subCategory) {
            return null;
        }

        if (isset($data['name']) && $data['name'] !== '') {
            $subCategory->name = $data['name'];
        }

        $subCategory->save();

        return $subCategory;
    }

    public function deleteSubCategory($id)
    {
        $subCategory = SubCategory::find($id);
        if (!$subCategory) {
            return null;
        }

        $subCategory->delete();

        return $subCategory;
    }
    

}