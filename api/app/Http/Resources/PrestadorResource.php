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
            'nome' => $this->nome,
            'id' => $this->id,
            'rg' => $this->rg,
            'cpf' => $this->cpf,
            'medico' => $this->medico,
            'telefones' => $this->telefones,
            'enderecos' => $this->enderecos,
            'roles' => $this->user != null ? $this->user->roles : null,
        ];
    }
}