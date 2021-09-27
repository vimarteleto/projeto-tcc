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
        // dd($categorias);
        return $categorias->toJson();        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Categoria::create([
            'nome' => $request->input('nome')
        ]);
        return redirect('/categorias');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $categoria = Categoria::find($id);
        // if (isset($categoria)) {
        //     return view('materiais.editarCategoria', compact('categoria'));
        // } else {
        //     return redirect('/categorias');
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        if (isset($categoria)) {
            $categoria->nome = $request->input('nome');
            $categoria->save();
        }
        return redirect('/categorias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        if (isset($categoria)) {
            $categoria->delete();
        }
        return redirect('/categorias');
    }


    /////////////////////////////////////////////

    public function indexView()
    {
        $categorias = Categoria::all();
        return view('materiais.categorias', compact('categorias'));
    }
}
