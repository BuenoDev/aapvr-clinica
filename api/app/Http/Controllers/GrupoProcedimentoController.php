<?php

namespace App\Http\Controllers;
use App\Http\Requests\GrupoProcedimentoRequest;
use App\GrupoProcedimento;
use App\Repositories\GrupoProcedimentoRepository;
use Illuminate\Http\Request;


class GrupoProcedimentoController extends Controller
{
    private $grupoprocedimento;
    public function __construct(GrupoProcedimentoRepository $grupoprocedimento)
    {
           $this->repo = $grupoprocedimento;
    }
    //index
    public function index()
    {
        return response()->json($this->repo->all());
    }
    //Metodo Cadastrar (Todas requisições do post $request->all)
    public function store (GrupoProcedimentoRequest $request)
    {
     $grupoprocedimento = $this->repo->create($request->all());
     return response()->json($grupoprocedimento,201);
    }

   //Atualizar
    public function update(GrupoProcedimentoRequest $request, GrupoProcedimento $grupoprocedimento)
    {
        $this->repo->setModel($grupoprocedimento);
        $this->repo->update($request->all());

        return response()->json(['success'=> 'Grupo de procedimento atualizado com sucesso!'],201);
    }

    public function destroy(GrupoProcedimento $grupoprocedimento)
    {
        $this->repo->setModel($grupoprocedimento);
        $this->repo->delete();

        return response()->json(['success'=> 'Grupo de procedimento deletado com sucesso!'],204);

    }

}