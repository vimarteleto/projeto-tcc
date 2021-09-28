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
            $unidade = Unidade::find($request->id);
            $unidade->nome = $request->nome;
            $unidade->save();

        } else {
            Unidade::create([
                'nome' => $request->nome
            ]);
        }
        
        return redirect('/unidades');
    }

    public function show($id)
    {
        $unidade = Unidade::find($id);
        return $unidade->toJson();  
    }

    public function update(Request $request)
    {
        $unidade = Unidade::find($request->id);
        if (isset($unidade)) {
            $unidade->nome = $request->nome;
            $unidade->save();
        }
        return redirect('/unidades');
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
