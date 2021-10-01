<?php

namespace App\Http\Controllers\Estoque;

use App\Http\Controllers\Controller;
use App\Models\Estoque\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    // retorna a view principal do crud do item, com relacionamentos e ordenado
    public function view()
    {
        // $estoques = Estoque::with('material.unidade', 'material.categoria')
        //     ->whereHas('material', function ($query) {
        //         return $query->where('status', 1);
        //     })
        // ->get();

        $estoques = Estoque::with('material.unidade', 'material.categoria')
            ->whereRelation('material', 'status', 1)
        ->paginate(10);

        return view('estoques.estoques', compact('estoques'));
    }


    public function store(Request $request)
    {
        $estoque = Estoque::find($request->id);

        if(isset($request->entrada)) {
            $estoque->update([
                'quantidade' => $estoque->quantidade + $request->entrada
            ]);
        }
        if(isset($request->saida)) {
            $estoque->update([
                'quantidade' => $estoque->quantidade - $request->saida
            ]);
        }
        if(isset($request->estoque)) {
            $estoque->update([
                'quantidade' => $request->estoque
            ]);
        }
        
        return redirect('/estoques')->with(['warning' => 'Estoque atualizado com sucesso!']);


    }
}
