<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestadorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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

        $prestador = [
            'nome' => $data['nome'],
            'nrConselho' => $data['nrConselho'],
            'rg' => $data['rg'],
            'cpf' => $data['cpf'],
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
            'prestador',
            'enderecos',
            'telefones'
        ]);
    }
}
