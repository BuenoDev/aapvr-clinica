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
            'nome' => $this->perfil->nome,
            'id' => $this->id,
            'rg' => $this->perfil->rg,
            'cpf' => $this->perfil->cpf,
            // 'medico' => new MedicoResource($this->medico),
            'telefones' => $this->perfil->telefones,
            'enderecos' => $this->perfil->enderecos,
            'roles' => $this->perfil->user != null ? $this->perfil->user->roles : null,
            'email' => $this->perfil->user != null ? $this->perfil->user->email : null,
        ];
    }
}
