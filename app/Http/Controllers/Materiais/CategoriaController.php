<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materiais\Categoria;

class CategoriaController extends Controller
{
    
    public function index()
    {
        $categorias = Categoria::all();
        return $categorias->toJson();        
    }

    public function store(Request $request)
    {
        if(isset($request->id)) {
            $categoria = Categoria::find($request->id);
            $categoria->update($request->all());
            return redirect('/categorias')->with(['warning' => 'Categoria atualizada com sucesso!']);

        } else {
            Categoria::create($request->all());
            return redirect('/categorias')->with(['success' => 'Categoria cadastrada com sucesso!']);
        }
    }

    public function show($id)
    {
        $categoria = Categoria::with('materiais')->find($id);
        return $categoria->toJson();  
    }

    public function destroy(Request $request)
    {
        $categoria = Categoria::find($request->id);
        if (isset($categoria)) {
            $categoria->delete();
        }
        return redirect('/categorias')->with(['danger' => 'Categoria excluída com sucesso!']);
    }

    /////////////////////////////////////////////

    public function view()
    {
        $categorias = Categoria::with('materiais')->get();
        return view('materiais.categorias', compact('categorias'));
    }
}
