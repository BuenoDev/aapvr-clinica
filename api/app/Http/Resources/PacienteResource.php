<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PacienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this['sexo'] = $this['sexo'] === 'M' ? 'Masculino' : 'Feminino';
        $this['dtnascimento'] = implode('/',array_reverse(explode('-', $this['dtnascimento'])));
        return parent::toArray($this);
    }
}
