<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostalCode extends JsonResource
{

    public function toArray($request)
    {

        return
        [
            'id'                => $this->id, 
            'codigo'            => $this->d_codigo,
            'd_asenta'          => $this->d_asenta,
            'd_tipo_asenta'     => $this->d_tipo_asenta,
            'D_mnpio'           => $this->D_mnpio,
            'd_estado'          => $this->d_estado,
            'd_ciudad'          => $this->d_ciudad,
            'd_CP'              => $this->d_CP,
            'dc_estado'         => $this->dc_estado,
            'c_oficina'         => $this->c_oficina,
            'c_CP'              => $this->c_CP,
            'c_tipo_asenta'     => $this->c_tipo_asenta,
            'c_mnpio'           => $this->c_mnpio,
            'd_zona'            => $this->d_zona,
            'c_cve_ciudad'      => $this->c_cve_ciudad,
            // City' => new CityResource($this->whenLoaded('city')), // Cargar la relación solo si está cargada
            // 'City' => new CityResource($this->city),
        ];

    }

}