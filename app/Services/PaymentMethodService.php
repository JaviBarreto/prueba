<?php

namespace App\Services;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class PaymentMethodService
{
    protected $paymentMethodModel;

    public function __construct(PaymentMethod $paymentMethodModel)
    {
        $this->paymentMethodModel = $paymentMethodModel;
    }

    public function createPaymentMethod($data)
    {
        $paymentMethod = PaymentMethod::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'paymentMethod' => $paymentMethod,
        ];
    }

    public function showPaymentMethod($id)
    {
        return PaymentMethod::where('user_id', $id)->get();
    }

    public function listPaymentMethods($perPage = 10, $page = 1)
    {
        return PaymentMethod::paginate($perPage, ['*'], 'page', $page);
    }

    public function updatePaymentMethod($data, $id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $paymentMethod->co = $data['co'];
        }

        $paymentMethod->save();

        return $paymentMethod;
    }

    public function deletePaymentMethod($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        if (!$paymentMethod) {
            return null;
        }

        $paymentMethod->delete();

        return $paymentMethod;
    }
}
