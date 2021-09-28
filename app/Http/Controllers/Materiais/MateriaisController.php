<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use App\Models\Materiais\Material;
use Illuminate\Http\Request;

class MateriaisController extends Controller
{
    // retorna um index com todos os itens, incluindo relacionamentos
    public function index()
    {
        $materiais = Material::with('categoria', 'unidade', 'grade')->get();
        return $materiais->toJson();        
    }

    // cria novos registros ou atualiza registros existentes
    public function store(Request $request)
    {
        if(isset($request->id)) {
            $material = Material::find($request->id);
            $material->update($request->all());

        } else {
            Material::create($request->all());
        }
        
        return redirect('/materiais');
    }

    // retorna um registro em especifico, incluindo relacionamentos
    public function show($id)
    {
        $material = Material::where('id',$id)->with('categoria', 'unidade', 'grade')->first();
        return $material->toJson();  
    }

    // deleta um registro
    public function destroy(Request $request)
    {
        $material = Material::find($request->id);
        if (isset($material)) {
            $material->delete();
        }
        return redirect('/materiais');
    }

    // retorna a view principal do crud do item, com relacionamentos e ordenado
    public function view()
    {
        $materiais = Material::with('categoria', 'unidade', 'grade')->orderBy('categoria_id')->get();
        return view('materiais.materiais', compact('materiais'));
    }
}
