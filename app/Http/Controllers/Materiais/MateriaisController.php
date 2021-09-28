<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use App\Models\Materiais\Material;
use Illuminate\Http\Request;

class MateriaisController extends Controller
{
    
    public function index()
    {
        $materiais = Material::with('categoria', 'unidade', 'grade')->get();
        return $materiais->toJson();        
    }

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

    public function show($id)
    {
        $material = Material::where('id',$id)->with('categoria', 'unidade', 'grade')->first();
        return $material->toJson();  
    }

    public function update(Request $request)
    {
        $material = Material::find($request->id);
        if (isset($material)) {
            $material = Material::find($request->id);
            $material->update($request->all());
        }
        return redirect('/materiais');
    }

    public function destroy(Request $request)
    {
        $material = Material::find($request->id);
        if (isset($material)) {
            $material->delete();
        }
        return redirect('/materiais');
    }

    /////////////////////////////////////////////

    public function view()
    {
        $materiais = Material::with('categoria', 'unidade', 'grade')->get();
        return view('materiais.materiais', compact('materiais'));
    }
}
