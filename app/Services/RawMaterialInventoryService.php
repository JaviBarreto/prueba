<?php

namespace App\Services;

use App\Models\RawMaterialInventory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class RawMaterialInventoryService
{
    protected $rawMaterialInventoryModel;

    public function __construct(RawMaterialInventory $rawMaterialInventoryModel)
    {
        $this->rawMaterialInventoryModel = $rawMaterialInventoryModel;
    }

    public function createRawMaterialInventory($data)
    {
        $rawMaterialInventory = RawMaterialInventory::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'rawMaterialInventory' => $rawMaterialInventory,
        ];
    }

    public function showRawMaterialInventory($id)
    {
        return RawMaterialInventory::where('user_id', $id)->get();
    }

    public function listRawMaterialInventories($perPage = 10, $page = 1)
    {
        return RawMaterialInventory::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateRawMaterialInventory($data, $id)
    {
        $rawMaterialInventory = RawMaterialInventory::find($id);

        if (!$rawMaterialInventory) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $rawMaterialInventory->co = $data['co'];
        }

        $rawMaterialInventory->save();

        return $rawMaterialInventory;
    }

    public function deleteRawMaterialInventory($id)
    {
        $rawMaterialInventory = RawMaterialInventory::find($id);
        if (!$rawMaterialInventory) {
            return null;
        }

        $rawMaterialInventory->delete();

        return $rawMaterialInventory;
    }
}
