<?php

namespace App\Services;

use App\Models\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class StorageService
{
    protected $storageModel;

    public function __construct(Storage $storageModel)
    {
        $this->storageModel = $storageModel;
    }

    public function createStorage($data)
    {
        $storage = Storage::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
        ]);

        return [
            'storage' => $storage,
        ];
    }

    public function showStorage($id)
    {
        return Storage::where('user_id', $id)->get();
    }

    public function listStorages($perPage = 10, $page = 1)
    {
        return Storage::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateStorage($data, $id)
    {
        $storage = Storage::find($id);

        if (!$storage) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $storage->co = $data['co'];
        }

        $storage->save();

        return $storage;
    }

    public function deleteStorage($id)
    {
        $storage = Storage::find($id);
        if (!$storage) {
            return null;
        }

        $storage->delete();

        return $storage;
    }
}
