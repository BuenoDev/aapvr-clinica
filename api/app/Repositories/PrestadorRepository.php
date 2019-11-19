<?php

namespace App\Repositories;

use App\Medico;
use App\Prestador;

class PrestadorRepository extends BaseRepository{
    public function __construct(Prestador $model,EnderecoRepository $endereco,TelefoneRepository $telefone)
    {
        $this->model = $model;
        $this->enderecoRepo = $endereco;
        $this->telefoneRepo = $telefone;
    }

    //TODO: vc consegue fazer melhor cara
    public function setModel(Prestador $prestador){
        $this->model = $prestador;
    }
    public function create($params, $user_id){
        $role = $params['prestador']['role'];
        $conselho = $params['prestador']['nrConselho'];

        unset($params['prestador']['nrConselho']);
        unset($params['prestador']['role']);

        $params['prestador']['user_id'] = $user_id;

        $prestador = Prestador::create($params['prestador']);
        $this->enderecoRepo->createMany($params['enderecos'],$prestador);
        $this->telefoneRepo->createMany($params['telefones'],$prestador);

        $prestador->user->assignRole($role);
        if($role === 'medico'){
            $medico = Medico::create([
                'nrconselho' => $conselho,
                'prestador_id' => $prestador->id
            ]);
            // $medico->especialidades()->sync();
        }

        return $prestador;
    }
    public function update($params){
        $prestador = $this->model->update($params['prestador']) ? $this->model : abort(500);
        $enderecos = $this->enderecoRepo->updateOrCreate($params['enderecos'],$prestador);
        $telefones = $this->telefoneRepo->updateOrCreate($params['telefones'],$prestador);

        return compact([
            'prestador',
            'enderecos',
            'telefones'
        ]);
    }
}