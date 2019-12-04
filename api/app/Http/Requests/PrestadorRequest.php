<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PrestadorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('editar-prestador');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * Formata a requisição de acordo com os parametros definidos
     *
     * @return void
     */
    public function formated(){
        $data = parent::all();

        if(isset($data['options'])) {
            $assign = $data['options']['userId'] != null ? $data['options']['userId'] : false;
        } else $assign = null;
        $user = [
            'name' => $data['nome'],
            'email' => $data['email'],
        ];
        $prestador = [
            'nome' => $data['nome'],
            'role' => $data['role']['label'],
            'rg' => $data['rg'],
            'cpf' => $data['cpf'],
        ];
        $medico = [
            'nrConselho' => $data['medico']['nrConselho'],
            'especialidades' => collect($data['medico']['especialidades'])->map(function($especialidade){
                return $especialidade['value'];
            })->toArray()
        ];
        $enderecos = collect($data['enderecos'])->map(function($endereco){
            $array = [
                'bairro' => $endereco['bairro'],
                'cep' => $endereco['cep'],
                'cidade' => $endereco['cidade'],
                'complemento' => $endereco['complemento'],
                'logradouro' => $endereco['logradouro'],
                'tipo' => $endereco['tipo'],
                'uf' => $endereco['uf'],
            ];
            if(isset($endereco['id'])) $array['id'] = $endereco['id'];

            return $array;
        })->toArray();
        $telefones = collect($data['telefones'])->map(function($telefone){
            $array = [
                'numero' => $telefone['numero'],
                'tipo' => $telefone['tipo'],
            ];
            if(isset($telefone['id'])) $array['id'] = $telefone['id'];

            return $array;
        })->toArray();
        return compact([
            'assign',
            'user',
            'prestador',
            'medico',
            'enderecos',
            'telefones'
        ]);
    }
}