<?php
namespace App\Repositories;

use App\Perfil;
use App\Prestador;
use App\TipoPrestador;
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

        if( isset($params['user']['id']) )
            $user = User::findOrFail($params['user']['id']);
        else if( ! isset($params['user']['id']) && isset($params['user']['email']) )
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
        $tipo = TipoPrestador::find($params['prestador']['tipoPrestador']);

        $prestador = $perfil->prestador()->create($params['prestador']);
        $prestador->tipoPrestador()->associate($tipo);

        $this->enderecoRepo->createMany($params['enderecos'],$perfil);
        $this->telefoneRepo->createMany($params['telefones'],$perfil);


        $prestador->especialidades()->sync($especialidades);

        return $prestador;
    }

    public function update($params){
        $this->forgetCache();

        $especialidades = $params['prestador']['especialidades'];
        unset($params['prestador']['especialidades']);

        if($this->model->perfil->user !== null)
            $this->model->perfil->user->update($params['user']);

        $prestador = $this->model->update($params['prestador']);
        $this->model->perfil->update($params['perfil']);
        $this->model->especialidades()->sync($especialidades);


        $enderecos = $this->enderecoRepo->updateOrCreate($params['enderecos'],$prestador);
        $telefones = $this->telefoneRepo->updateOrCreate($params['telefones'],$prestador);

        return $prestador;
    }
}
