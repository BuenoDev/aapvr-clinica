<?php

namespace App\Http\Controllers;

use App\Prestador;
use App\Repositories\PrestadorRepository;
use Illuminate\Http\Request;

class PrestadorController extends Controller
{
    public function __construct(PrestadorRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo->create($this->formatRequest($request));
        return response()->json();
    }

    private function formatRequest($request)
    {
        $prestador = [
            'nome' => $request->nome,
            'nrConselho' => $request->nrConselho,
            'rg' => $request->rg,
            'cpf' => $request->cpf,
        ];
        $enderecos = collect($request->enderecos)->map(function($endereco){
            return [
                'bairro' => $endereco['bairro'],
                'cep' => $endereco['cep'],
                'cidade' => $endereco['cidade'],
                'complemento' => $endereco['complemento'],
                'logradouro' => $endereco['logradouro'],
                'tipo' => $endereco['tipo'],
                'uf' => $endereco['uf'],
            ];
        })->toArray();
        $telefones = $request->telefones;
        return compact([
            'prestador',
            'enderecos',
            'telefones'
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Prestador  $prestador
     * @return \Illuminate\Http\Response
     */
    public function show(Prestador $prestador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prestador  $prestador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestador $prestador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestador  $prestador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestador $prestador)
    {
        //
    }
}
