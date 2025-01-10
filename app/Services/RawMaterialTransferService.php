<?php

namespace App\Services;

use App\Models\RawMaterialTransfer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class RawMaterialTransferService
{
    protected $rawMaterialTransferModel;

    public function __construct(RawMaterialTransfer $rawMaterialTransferModel)
    {
        $this->rawMaterialTransferModel = $rawMaterialTransferModel;
    }

    public function createRawMaterialTransfer($data)
    {
        $rawMaterialTransfer = RawMaterialTransfer::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'rawMaterialTransfer' => $rawMaterialTransfer,
        ];
    }

    public function showRawMaterialTransfer($id)
    {
        return RawMaterialTransfer::where('user_id', $id)->get();
    }

    public function listRawMaterialTransfers($perPage = 10, $page = 1)
    {
        return RawMaterialTransfer::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateRawMaterialTransfer($data, $id)
    {
        $rawMaterialTransfer = RawMaterialTransfer::find($id);

        if (!$rawMaterialTransfer) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $rawMaterialTransfer->co = $data['co'];
        }

        $rawMaterialTransfer->save();

        return $rawMaterialTransfer;
    }

    public function deleteRawMaterialTransfer($id)
    {
        $rawMaterialTransfer = RawMaterialTransfer::find($id);
        if (!$rawMaterialTransfer) {
            return null;
        }

        $rawMaterialTransfer->delete();

        return $rawMaterialTransfer;
    }
}
