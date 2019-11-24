<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProcedimentoRequest;
use App\Procedimento;
use Illuminate\Http\Request;

class ProcedimentoController extends Controller
{
    private $procedimento;
    public function __construct(Procedimento $procedimento)
    {
           $this->procedimento = $procedimento;
    }

    public function index()
    {
        return response()->json(Procedimento::get());
    }

    public function store (ProcedimentoRequest $request)
    {
     $procedimento = $this->procedimento->create($request->all()); 
     return response()->json($procedimento,201);
    }

    public function update(ProcedimentoRequest $request, $id)
    {   
        if (!$procedimento = $this->procedimento->find($id))
        return response()->json(['error'=> 'Procedimento não encontrado!'],404);

                  $procedimento->update($request->all()); 
            return response()->json(['success'=> 'Procedimento atualizado com sucesso!'],201);
    }

    public function destroy($id)
    {
        if (!$procedimento = $this->procedimento->find($id))
        return response()->json(['error'=> 'Procedimento não encontrado!'],404);

        $procedimento->delete();
        return response()->json(['success'=> 'Procedimento deletado com sucesso!'],204);

    }

}
