<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use App\Models\Materiais\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    
    public function index()
    {
        $unidades = Unidade::with('materiais')->get();
        return $unidades->toJson();        
    }

    public function store(Request $request)
    {
        if(isset($request->id)) {
            $unidade = Unidade::find($request->id);
            $unidade->update($request->all());
            return redirect('/unidades')->with(['warning' => 'Unidade atualizada com sucesso!']);

        } else {
            Unidade::create($request->all());
            return redirect('/unidades')->with(['success' => 'Unidade cadastrada com sucesso!']);
        }
        
        return redirect('/unidades');
    }

    public function show($id)
    {
        $unidade = Unidade::with('materiais')->find($id);
        return $unidade->toJson();  
    }

    public function destroy(Request $request)
    {
        $unidade = Unidade::find($request->id);
        if (isset($unidade)) {
            $unidade->delete();
        }
        return redirect('/unidades')->with(['danger' => 'Unidade excluída com sucesso!']);
    }

    /////////////////////////////////////////////

    public function view()
    {
        $unidades = Unidade::with('materiais')->get();
        return view('materiais.unidades', compact('unidades'));
    }
}
