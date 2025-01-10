<?php

namespace App\Services;

use App\Models\ClientAddress;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ClientAddressService
{
    protected $clientAddressModel;

    public function __construct(ClientAddress $clientAddressModel)
    {
        $this->clientAddressModel = $clientAddressModel;
    }

    public function createClientAddress($data)
    {
        $clientAddress = ClientAddress::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'clientAddress' => $clientAddress,
        ];
    }

    public function showClientAddress($id)
    {
        return ClientAddress::where('user_id', $id)->get();
    }

    public function listClientAddresses($perPage = 10, $page = 1)
    {
        return ClientAddress::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateClientAddress($data, $id)
    {
        $clientAddress = ClientAddress::find($id);

        if (!$clientAddress) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $clientAddress->co = $data['co'];
        }

        $clientAddress->save();

        return $clientAddress;
    }

    public function deleteClientAddress($id)
    {
        $clientAddress = ClientAddress::find($id);
        if (!$clientAddress) {
            return null;
        }

        $clientAddress->delete();

        return $clientAddress;
    }
}
