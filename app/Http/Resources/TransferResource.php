<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                => $this->id, 
            'createdAt' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updatedAt' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,
            'deletedAt' => $this->deleted_at ? $this->deleted_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
