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
        $conselho = $params['medico']['nrConselho'];
        $especialidades = $params['medico']['especialidades'];

        unset($params['medico']['nrConselho']);
        unset($params['prestador']['role']);
        unset($params['medico']['especialidades']);

        $params['prestador']['user_id'] = $user_id;

        $prestador = Prestador::create($params['prestador']);
        $this->enderecoRepo->createMany($params['enderecos'],$prestador);
        $this->telefoneRepo->createMany($params['telefones'],$prestador);

        $prestador->user->syncRoles($role);
        if($role === 'medico'){
            $medico = Medico::create([
                'nrconselho' => $conselho,
                'prestador_id' => $prestador->id
            ]);
            $medico->especialidades()->sync($especialidades);
        }

        return $prestador;
    }
    public function update($params){
        $prestador = $this->model->update($params['prestador']) ? $this->model : abort(500);
        $this->model->user->update($params['user']);
        $this->model->user->syncRoles($params['prestador']['role']);

        if($this->model->user->hasRole('medico')){

            if($this->model->medico === null) {
                $this->model->medico()->create([
                    'nrconselho' => $params['medico']['nrConselho']
                ]);
            } else $this->model->medico->update([
                'nrconselho' => $params['medico']['nrConselho']
            ]);

            $this->model->medico->especialidades()->sync($params['medico']['especialidades']);
        } else if($this->model->medico != null) {
            $this->model->medico->delete();
        }
        $enderecos = $this->enderecoRepo->updateOrCreate($params['enderecos'],$prestador);
        $telefones = $this->telefoneRepo->updateOrCreate($params['telefones'],$prestador);

        return compact([
            'prestador',
            'enderecos',
            'telefones'
        ]);
    }
}