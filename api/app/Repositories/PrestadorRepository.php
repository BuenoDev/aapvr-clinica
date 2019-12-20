<?php
namespace App\Repositories;

use App\Perfil;
use App\Prestador;

class PrestadorRepository extends BaseRepository{
    public function __construct(Prestador $model,EnderecoRepository $endereco,TelefoneRepository $telefone)
    {
        $this->model = $model;
        $this->enderecoRepo = $endereco;
        $this->telefoneRepo = $telefone;

        $this->setEager([
            'especialidades',
            'perfil',
            'perfil.enderecos',
            'perfil.telefones',
        ]);
    }

    public function create($params){
        parent::forgetCache();

        $role = $params['prestador']['role'];
        $especialidades = $params['prestador']['especialidades'];
        // $conselho = $params['prestador']['nrConselho'];

        // unset($params['prestador']['nrConselho']);
        unset($params['prestador']['role']);
        unset($params['prestador']['especialidades']);

        $params['prestador']['user_id'] = $user_id;

        $perfil = Perfil::create($params['perfil']);
        $prestador = $perfil->prestador()->create($params['prestador']);

        $prestador->user->syncRoles($role);
        $this->enderecoRepo->createMany($params['enderecos'],$prestador);
        $this->telefoneRepo->createMany($params['telefones'],$prestador);


        $prestador->especialidades()->sync($especialidades);

        return $prestador;
    }
    public function update($params){
        parent::forgetCache();
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
