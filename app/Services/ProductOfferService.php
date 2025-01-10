<?php

namespace App\Services;

use App\Models\ProductOffer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ProductOfferService
{
    protected $productOfferModel;

    public function __construct(ProductOffer $productOfferModel)
    {
        $this->productOfferModel = $productOfferModel;
    }

    public function createProductOffer($data)
    {
        $productOffer = ProductOffer::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'productOffer' => $productOffer,
        ];
    }

    public function showProductOffer($id)
    {
        return ProductOffer::where('user_id', $id)->get();
    }

    public function listProductOffers($perPage = 10, $page = 1)
    {
        return ProductOffer::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateProductOffer($data, $id)
    {
        $productOffer = ProductOffer::find($id);

        if (!$productOffer) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $productOffer->co = $data['co'];
        }

        $productOffer->save();

        return $productOffer;
    }

    public function deleteProductOffer($id)
    {
        $productOffer = ProductOffer::find($id);
        if (!$productOffer) {
            return null;
        }

        $productOffer->delete();

        return $productOffer;
    }
}
