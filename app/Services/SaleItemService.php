<?php

namespace App\Services;

use App\Models\SaleItem;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class SaleItemService
{
    protected $saleItemModel;

    public function __construct(SaleItem $saleItemModel)
    {
        $this->saleItemModel = $saleItemModel;
    }

    public function createSaleItem($data)
    {
        $saleItem = SaleItem::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'saleItem' => $saleItem,
        ];
    }

    public function showSaleItem($id)
    {
        return SaleItem::where('user_id', $id)->get();
    }

    public function listSaleItems($perPage = 10, $page = 1)
    {
        return SaleItem::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateSaleItem($data, $id)
    {
        $saleItem = SaleItem::find($id);

        if (!$saleItem) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $saleItem->co = $data['co'];
        }

        $saleItem->save();

        return $saleItem;
    }

    public function deleteSaleItem($id)
    {
        $saleItem = SaleItem::find($id);
        if (!$saleItem) {
            return null;
        }

        $saleItem->delete();

        return $saleItem;
    }
}
