<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use App\Models\Materiais\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    
    public function index()
    {
        $unidades = Unidade::all();
        return $unidades->toJson();        
    }

    public function store(Request $request)
    {
        if(isset($request->id)) {
            $material = Unidade::find($request->id);
            $material->update($request->all());

        } else {
            Unidade::create($request->all());
        }
        
        return redirect('/unidades');
    }

    public function show($id)
    {
        $unidade = Unidade::find($id);
        return $unidade->toJson();  
    }

    public function destroy(Request $request)
    {
        $unidade = Unidade::find($request->id);
        if (isset($unidade)) {
            $unidade->delete();
        }
        return redirect('/unidades');
    }

    /////////////////////////////////////////////

    public function view()
    {
        $unidades = Unidade::all();
        return view('materiais.unidades', compact('unidades'));
    }
}
