<?php

namespace App\Services;

use App\Models\Provider;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ProviderService
{
    protected $providerModel;

    public function __construct(Provider $providerModel)
    {
        $this->providerModel = $providerModel;
    }

    public function createProvider($data)
    {
        $provider = Provider::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'provider' => $provider,
        ];
    }

    public function showProvider($id)
    {
        return Provider::where('user_id', $id)->get();
    }

    public function listProviders($perPage = 10, $page = 1)
    {
        return Provider::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateProvider($data, $id)
    {
        $provider = Provider::find($id);

        if (!$provider) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $provider->co = $data['co'];
        }

        $provider->save();

        return $provider;
    }

    public function deleteProvider($id)
    {
        $provider = Provider::find($id);
        if (!$provider) {
            return null;
        }

        $provider->delete();

        return $provider;
    }
}
