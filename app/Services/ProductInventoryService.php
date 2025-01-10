<?php

namespace App\Services;

use App\Models\ProductInventory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ProductInventoryService
{
    protected $productInventoryModel;

    public function __construct(ProductInventory $productInventoryModel)
    {
        $this->productInventoryModel = $productInventoryModel;
    }

    public function createProductInventory($data)
    {
        $productInventory = ProductInventory::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'productInventory' => $productInventory,
        ];
    }

    public function showProductInventory($id)
    {
        return ProductInventory::where('user_id', $id)->get();
    }

    public function listProductInventories($perPage = 10, $page = 1)
    {
        return ProductInventory::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateProductInventory($data, $id)
    {
        $productInventory = ProductInventory::find($id);

        if (!$productInventory) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $productInventory->co = $data['co'];
        }

        $productInventory->save();

        return $productInventory;
    }

    public function deleteProductInventory($id)
    {
        $productInventory = ProductInventory::find($id);
        if (!$productInventory) {
            return null;
        }

        $productInventory->delete();

        return $productInventory;
    }
}
