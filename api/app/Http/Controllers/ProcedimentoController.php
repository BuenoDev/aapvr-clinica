<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProcedimentoRequest;
use App\Http\Resources\ProcedimentoResource;
use App\Repositories\ProcedimentoRepository;


class ProcedimentoController extends Controller
{
    public function __construct(ProcedimentoRepository $procedimento)
    {
       $this->repo = $procedimento;
    }

    public function index()
    {
        return response()->json(
            ProcedimentoResource::collection($this->repo->all())
        );
    }

    public function store (ProcedimentoRequest $request)
    {
        $this->repo->create($request->formated());
    }

    public function update(ProcedimentoRequest $request, $id)
    {
        $this->repo->findById($id);
        $this->repo->update($request->formated());
    }

    public function destroy($id)
    {
        $this->repo->findById($id);
        $this->repo->delete();

    }

}