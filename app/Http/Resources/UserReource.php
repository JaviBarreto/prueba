<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserReource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id'                => $this->id, 
            'name'            => $this->name,
            'email'          => $this->email,
            // 'password'     => $this->d_tipo_asenta,
            'userTypeId'           => $this->user_type_id,
            'createdAt' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updatedAt' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,
            'deletedAt' => $this->deleted_at ? $this->deleted_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
