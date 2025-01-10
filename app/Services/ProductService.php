<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ProductService
{
    protected $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function createProduct($data)
    {
        $product = Product::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'product' => $product,
        ];
    }

    public function showProduct($id)
    {
        return Product::where('user_id', $id)->get();
    }

    public function listProducts($perPage = 10, $page = 1)
    {
        return Product::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateProduct($data, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $product->co = $data['co'];
        }

        $product->save();

        return $product;
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return null;
        }

        $product->delete();

        return $product;
    }
}
