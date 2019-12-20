<?php
namespace App\Repositories;

use App\Perfil;
use App\Prestador;
use App\User;

class PrestadorRepository extends BaseRepository{
    public function __construct(
        Prestador $model,
        EnderecoRepository $endereco,
        TelefoneRepository $telefone,
        UserRepository $user
    )
    {
        $this->model = $model;
        $this->userRepo = $user;
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

        //Cria usuario se solicitado
        // TODO: Modificar para que possa criar prestador
        // sem nenhum usuario

        //Undefined index id - atribuindo usuario
        if($params['user']['id'] != null)
            $user = User::findOrFail($params['user']['id']);
        else if($params['user']['id'] == null && $params['user']['email'] != null)
            $user = $this->userRepo->createDefault($params['user']);
        else $user = false;
        // formata parametros


        $especialidades = $params['prestador']['especialidades'];
        unset($params['prestador']['especialidades']);

        //Cria prestador

        /**
         * Criar perfil
         * cria prestador do perfil
         * se precisar criar o usuario, cria o usuario do perfil
         * senao, associar o usuario ao perfil
         *
         */
        $perfil = Perfil::create($params['perfil']);

        // Se o usuario existir ou tiver sido criado, role === prestador
        if(!! $user){
            $perfil->user()->save($user);
            $perfil->user->syncRoles('prestador');
        }

        $prestador = $perfil->prestador()->create($params['prestador']);

        $this->enderecoRepo->createMany($params['enderecos'],$perfil);
        $this->telefoneRepo->createMany($params['telefones'],$perfil);


        $prestador->especialidades()->sync($especialidades);

        return $prestador;
    }

    public function update($params){
        $this->forgetCache();

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
