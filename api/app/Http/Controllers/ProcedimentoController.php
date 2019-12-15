<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProcedimentoRequest;
use App\Repositories\ProcedimentoRepository;


class ProcedimentoController extends Controller
{
    public function __construct(ProcedimentoRepository $procedimento)
    {
       $this->repo = $procedimento;
    }

    public function index()
    {
        return response()->json($this->repo->all());
    }

    public function store (ProcedimentoRequest $request)
    {
        $this->repo->create($request->formated());
    }

    public function update(ProcedimentoRequest $request, $id)
    {
        $this->repo->findById($id);
        $this->repo->update($request->all());
    }

    public function destroy($id)
    {
        $this->repo->findById($id);
        $this->repo->delete();

    }

}