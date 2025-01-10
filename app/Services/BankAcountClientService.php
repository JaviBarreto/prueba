<?php

namespace App\Services;

use App\Models\BankAcountClient;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class BankAcountClientService
{
    protected $bankAcountClientModel;

    public function __construct(BankAcountClient $bankAcountClientModel)
    {
        $this->bankAcountClientModel = $bankAcountClientModel;
    }

    public function createBankAcountClient($data)
    {
        $bankAcountClient = BankAcountClient::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'bankAcountClient' => $bankAcountClient,
        ];
    }

    public function showBankAcountClient($id)
    {
        return BankAcountClient::where('user_id', $id)->get();
    }

    public function listBankAcountClients($perPage = 10, $page = 1)
    {
        return BankAcountClient::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateBankAcountClient($data, $id)
    {
        $bankAcountClient = BankAcountClient::find($id);

        if (!$bankAcountClient) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $bankAcountClient->co = $data['co'];
        }

        $bankAcountClient->save();

        return $bankAcountClient;
    }

    public function deleteBankAcountClient($id)
    {
        $bankAcountClient = BankAcountClient::find($id);
        if (!$bankAcountClient) {
            return null;
        }

        $bankAcountClient->delete();

        return $bankAcountClient;
    }
}
