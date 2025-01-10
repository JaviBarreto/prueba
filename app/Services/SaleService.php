<?php

namespace App\Services;

use App\Models\Sale;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class SaleService
{
    protected $saleModel;

    public function __construct(Sale $saleModel)
    {
        $this->saleModel = $saleModel;
    }

    public function createSale($data)
    {
        $sale = Sale::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'sale' => $sale,
        ];
    }

    public function showSale($id)
    {
        return Sale::where('user_id', $id)->get();
    }

    public function listSales($perPage = 10, $page = 1)
    {
        return Sale::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateSale($data, $id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $sale->co = $data['co'];
        }

        $sale->save();

        return $sale;
    }

    public function deleteSale($id)
    {
        $sale = Sale::find($id);
        if (!$sale) {
            return null;
        }

        $sale->delete();

        return $sale;
    }
}
