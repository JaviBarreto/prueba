<?php

namespace App\Services;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class OrderItemService
{
    protected $orderItemModel;

    public function __construct(OrderItem $orderItemModel)
    {
        $this->orderItemModel = $orderItemModel;
    }

    public function createOrderItem($data)
    {
        $orderItem = OrderItem::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'orderItem' => $orderItem,
        ];
    }

    public function showOrderItem($id)
    {
        return OrderItem::where('user_id', $id)->get();
    }

    public function listOrderItems($perPage = 10, $page = 1)
    {
        return OrderItem::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateOrderItem($data, $id)
    {
        $orderItem = OrderItem::find($id);

        if (!$orderItem) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $orderItem->co = $data['co'];
        }

        $orderItem->save();

        return $orderItem;
    }

    public function deleteOrderItem($id)
    {
        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            return null;
        }

        $orderItem->delete();

        return $orderItem;
    }
}
