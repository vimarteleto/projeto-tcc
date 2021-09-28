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
            $categoria->nome = $request->nome;
            $categoria->save();

        } else {
            Categoria::create([
                'nome' => $request->nome
            ]);
        }
        
        return redirect('/categorias');
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);
        return $categoria->toJson();  
    }

    public function update(Request $request)
    {
        $categoria = Categoria::find($request->id);
        if (isset($categoria)) {
            $categoria->nome = $request->nome;
            $categoria->save();
        }
        return redirect('/categorias');
    }

    public function destroy(Request $request)
    {
        $categoria = Categoria::find($request->id);
        if (isset($categoria)) {
            $categoria->delete();
        }
        return redirect('/categorias');
    }

    /////////////////////////////////////////////

    public function view()
    {
        $categorias = Categoria::all();
        return view('materiais.categorias', compact('categorias'));
    }
}
