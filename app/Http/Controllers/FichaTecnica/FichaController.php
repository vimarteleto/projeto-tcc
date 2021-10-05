<?php

namespace App\Http\Controllers\FichaTecnica;

use App\Http\Controllers\Controller;
use App\Models\FichaTecnica\CorReferencia;
use App\Models\FichaTecnica\Ficha;
use App\Models\FichaTecnica\Referencia;
use Illuminate\Http\Request;

class FichaController extends Controller
{
    
    public function index()
    {
        $fichas = Ficha::all();
        return $fichas->toJson();        
    }

    public function store(Request $request)
    {
        if(isset($request->id)) {
            $ficha = Ficha::find($request->id);
            $ficha->update($request->all());
            return redirect()->back()->with(['warning' => 'Ficha atualizada com sucesso!']);

        } else {
            
            Ficha::create($request->all());
            return redirect()->back()->with(['success' => 'Item adicionado com sucesso!']);
        }
    }

    public function show($id)
    {
        $ficha = Ficha::with('material')->find($id);
        return $ficha->toJson();  
    }

    public function destroy(Request $request)
    {
        $ficha = Ficha::find($request->id);
        if (isset($ficha)) {
            $ficha->delete();
        }
        return redirect()->back()->with(['danger' => 'Item excluído com sucesso!']);
    }

    /////////////////////////////////////////////

    public function view($id)
    {
        $sku = CorReferencia::with('cor', 'referencia')->find($id);
        $itens = Ficha::with('material.categoria')->where('cor_referencia_id', $id)->orderBy('sequencia')->get();
            // ->whereRelation('linha', 'status', 1)
        // ->paginate(10);
        // ->get();

        return view('ficha.fichas', compact('sku', 'itens'));

    }
}
