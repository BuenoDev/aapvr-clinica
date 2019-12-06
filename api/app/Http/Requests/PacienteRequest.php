<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return Auth::user()->can('editar-paciente');
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

    public function formated(){
        $data = parent::all();

        $paciente = [
            'nome' => $data['nome'],
            'rg' => $data['rg'],
            'cpf' => $data['cpf'],
            'mae' => $data['mae'],
            'dtnascimento' => new Carbon(implode('-', explode('/', $data['dtnascimento']))),
            'sexo' => $data['sexo'] === 'Masculino' ? 'M' : 'F',
            'estadoCivil' => $data['estadoCivil'],
            'observacao' => $data['observacao'],
        ];

        $telefones = collect($data['telefones'])->map(function ($telefone) {
            $array = [
                'numero' => $telefone['numero'],
                'tipo' => $telefone['tipo'],
            ];
            if (isset($telefone['id'])) $array['id'] = $telefone['id'];
            return $array;
        })->toArray();

        $enderecos = collect($data['enderecos'])->map(function ($endereco) {
            $array = [
                'bairro' => $endereco['bairro'],
                'cep' => $endereco['cep'],
                'cidade' => $endereco['cidade'],
                'complemento' => $endereco['complemento'],
                'logradouro' => $endereco['logradouro'],
                'tipo' => $endereco['tipo'],
                'uf' => $endereco['uf'],
            ];
            if (isset($endereco['id'])) $array['id'] = $endereco['id'];

            return $array;
        })->toArray();


        return compact([
            'paciente',
            'telefones',
            'enderecos'
        ]);
    }
}