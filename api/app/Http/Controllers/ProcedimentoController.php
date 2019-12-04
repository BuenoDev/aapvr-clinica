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
    }

    public function update(ProcedimentoRequest $request, $id)
    {   
        if ($procedimento = $this->procedimento->find($id))
        $procedimento->update($request->all());
    }

    public function destroy($id)
    {
        if ($procedimento = $this->procedimento->find($id))
        $procedimento->delete();

    }

}
