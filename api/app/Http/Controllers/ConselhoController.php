<?php

namespace App\Http\Controllers;
use App\Http\Requests\ConselhoRequest;
use App\Conselho;
use Illuminate\Http\Request;


class ConselhoController extends Controller
{
    private $conselho;
    public function __construct(Conselho $conselho)
    {
           $this->conselho = $conselho;
    }
    
    public function index()
    {
        return response()->json(Conselho::get());
    }

    public function store (ConselhoRequest $request)
    {
        $conselho = $this->conselho->create($request->all()); 
    }

    public function update(ConselhoRequest $request, $id)
    {   
        if ($conselho = $this->conselho->find($id))
        $conselho->update($request->all());
    }

    public function destroy($id)
    {
        if ($conselho = $this->conselho->find($id))
        $conselho->delete();

    }

}
