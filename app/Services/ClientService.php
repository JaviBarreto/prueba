<?php

namespace App\Services;

use App\Models\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ClientService
{
    protected $clientModel;

    public function __construct(Client $clientModel)
    {
        $this->clientModel = $clientModel;
    }

    public function createClient($data)
    {
        $client = Client::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'client' => $client,
        ];
    }

    public function showClient($id)
    {
        return Client::where('user_id', $id)->get();
    }

    public function listClients($perPage = 10, $page = 1)
    {
        return Client::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateClient($data, $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $client->co = $data['co'];
        }

        $client->save();

        return $client;
    }

    public function deleteClient($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return null;
        }

        $client->delete();

        return $client;
    }
}
