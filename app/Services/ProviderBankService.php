<?php

namespace App\Services;

use App\Models\ProviderBank;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ProviderBankService
{
    protected $providerBankModel;

    public function __construct(ProviderBank $providerBankModel)
    {
        $this->providerBankModel = $providerBankModel;
    }

    public function createProviderBank($data)
    {
        $providerBank = ProviderBank::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'providerBank' => $providerBank,
        ];
    }

    public function showProviderBank($id)
    {
        return ProviderBank::where('user_id', $id)->get();
    }

    public function listProviderBanks($perPage = 10, $page = 1)
    {
        return ProviderBank::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateProviderBank($data, $id)
    {
        $providerBank = ProviderBank::find($id);

        if (!$providerBank) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $providerBank->co = $data['co'];
        }

        $providerBank->save();

        return $providerBank;
    }

    public function deleteProviderBank($id)
    {
        $providerBank = ProviderBank::find($id);
        if (!$providerBank) {
            return null;
        }

        $providerBank->delete();

        return $providerBank;
    }
}
