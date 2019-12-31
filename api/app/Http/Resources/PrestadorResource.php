<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrestadorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'prestador' => [
                'nrConselho' => $this->nrConselho,
                'tipoPrestador' => $this->tipoPrestador,
                'especialidades' => $this->especialidades,
            ],
            'user' => $this->perfil->user,
            'perfil' => $this->perfil,
            'telefones' => $this->perfil->telefones,
            'enderecos' => $this->perfil->enderecos,
        ];
    }
}
