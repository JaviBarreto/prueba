<?php

namespace App\Services;

use App\Models\Transfer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class TransferService
{
    protected $transferModel;

    public function __construct(Transfer $transferModel)
    {
        $this->transferModel = $transferModel;
    }

    public function createTransfer($data)
    {
        $transfer = Transfer::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'transfer' => $transfer,
        ];
    }

    public function showTransfer($id)
    {
        return Transfer::where('user_id', $id)->get();
    }

    public function listTransfers($perPage = 10, $page = 1)
    {
        return Transfer::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateTransfer($data, $id)
    {
        $transfer = Transfer::find($id);

        if (!$transfer) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $transfer->co = $data['co'];
        }

        $transfer->save();

        return $transfer;
    }

    public function deleteTransfer($id)
    {
        $transfer = Transfer::find($id);
        if (!$transfer) {
            return null;
        }

        $transfer->delete();

        return $transfer;
    }
}
