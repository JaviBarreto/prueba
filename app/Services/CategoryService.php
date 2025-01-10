<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    protected $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    public function createCategory($data)
    {
        $category = Category::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'category' => $category,
        ];
    }

    public function showCategory($id)
    {
        return Category::where('user_id', $id)->get();
    }

    public function listCategories($perPage = 10, $page = 1)
    {
        return Category::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateCategory($data, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $category->co = $data['co'];
        }

        $category->save();

        return $category;
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return null;
        }

        $category->delete();

        return $category;
    }
}
