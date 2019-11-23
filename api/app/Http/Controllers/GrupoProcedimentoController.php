<?php

namespace App\Http\Controllers;
use App\Http\Requests\GrupoProcedimentoRequest;
use App\GrupoProcedimento;
use Illuminate\Http\Request;


class GrupoProcedimentoController extends Controller
{
    private $grupoprocedimento;
    public function __construct(GrupoProcedimento $grupoprocedimento)
    {
           $this->grupoprocedimento = $grupoprocedimento;
    }
    //index
    public function index()
    {
        return response()->json(GrupoProcedimento::get());
    }
    //Metodo Cadastrar (Todas requisições do post $request->all)
    public function store (GrupoProcedimentoRequest $request)
    {
     $grupoprocedimento = $this->grupoprocedimento->create($request->all()); 
     return response()->json($grupoprocedimento,201);
    }

   //Atualizar
    public function update(GrupoProcedimentoRequest $request, $id)
    {   
        if (!$grupoprocedimento = $this->grupoprocedimento->find($id))
        return response()->json(['error'=> 'Grupo de procedimento não encontrado!'],404);

                  $grupoprocedimento->update($request->all()); 
            return response()->json(['success'=> 'Grupo de procedimento atualizado com sucesso!'],201);
    }

    public function destroy($id)
    {
        if (!$grupoprocedimento = $this->grupoprocedimento->find($id))
        return response()->json(['error'=> 'Grupo de procedimento não encontrado!'],404);

        $grupoprocedimento->delete();
        return response()->json(['success'=> 'Grupo de procedimento deletado com sucesso!'],204);

    }

}
