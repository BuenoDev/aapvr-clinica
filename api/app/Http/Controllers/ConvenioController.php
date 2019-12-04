<?php

namespace App\Http\Controllers;
use App\Http\Requests\ConvenioRequest;
use App\Convenio;
use Illuminate\Http\Request;


class ConvenioController extends Controller
{
    private $convenio;
    public function __construct(Convenio $convenio)
    {
           $this->convenio = $convenio;
    }
    
    public function index()
    {
        return response()->json(Convenio::get());
    }

    public function store (ConvenioRequest $request)
    {
        //$convenio = $this->convenio->create($request->all()); 
        var_dump($this->convenio->create($request->all()));
    }

    public function update(ConvenioRequest $request, $id)
    {   
        if ($convenio = $this->convenio->find($id))
        $convenio->update($request->all());
    }

    public function destroy($id)
    {
        if ($convenio = $this->convenio->find($id))
        $convenio->delete();

    }

}

