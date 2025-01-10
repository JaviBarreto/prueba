<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class AddressService
{
    protected $addressModel;

    public function __construct(Address $addressModel)
    {
        $this->addressModel = $addressModel;
    }

    public function createAddress($data)
    {
        $address = Address::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
            // 'email' => $data['email'],
        ]);

        return [
            'address' => $address,
        ];
    }

    public function showAddress($id)
    {
        return Address::where('user_id',$id)->get();
    }

    public function listAddresses($perPage = 10, $page = 1)
    {
        return Address::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateAddress($data, $id)
    {
        $address = Address::find($id);

        if (!$address) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $address->co = $data['co'];
        }

        $address->save();

        return $address;
    }

    public function deleteAddress($id)
    {
        $address = Address::find($id);
        if (!$address) {
            return null;
        }

        $address->delete();

        return $address;
    }
}
