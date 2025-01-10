<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $orderModel;

    public function __construct(Order $orderModel)
    {
        $this->orderModel = $orderModel;
    }

    public function createOrder($data)
    {
        $order = Order::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'order' => $order,
        ];
    }

    public function showOrder($id)
    {
        return Order::where('user_id', $id)->get();
    }

    public function listOrders($perPage = 10, $page = 1)
    {
        return Order::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateOrder($data, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $order->co = $data['co'];
        }

        $order->save();

        return $order;
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return null;
        }

        $order->delete();

        return $order;
    }
}
