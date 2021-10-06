<?php

namespace App\Http\Controllers\FichaTecnica;

use App\Http\Controllers\Controller;
use App\Models\FichaTecnica\CorReferencia;
use App\Models\FichaTecnica\Ficha;
use Illuminate\Http\Request;

class CorReferenciaController extends Controller
{
    
    public function index()
    {
        $skus = CorReferencia::all();
        return $skus->toJson();        
    }

    public function store(Request $request)
    {
        if(isset($request->id)) {
            $sku = CorReferencia::find($request->id);
            $sku->update($request->all());
            return redirect('/skus')->with(['warning' => 'SKU atualizado com sucesso!']);

        } else {
            CorReferencia::create($request->all());
            return redirect('/skus')->with(['success' => 'SKU cadastrado com sucesso!']);
        }
    }

    public function show($id)
    {
        $sku = CorReferencia::with('cor', 'referencia.linha')->find($id);
        return $sku->toJson();  
    }

    public function destroy(Request $request)
    {
        $sku = CorReferencia::find($request->id);
        if (isset($sku)) {
            $sku->delete();
        }
        return redirect('/skus')->with(['danger' => 'SKU excluído com sucesso!']);
    }

    /////////////////////////////////////////////

    public function view()
    {
        $skus = CorReferencia::with('cor', 'referencia.linha')
            // ->whereRelation('linha', 'status', 1)
        // ->paginate(10);
        ->orderBy('referencia_id')
        ->get();

        return view('ficha.skus', compact('skus'));

    }

    // alteracao de status
    public function status($id)
    {
        $linha = CorReferencia::find($id);

        if ($linha->status == 0){
            $linha->status = 1;
        } else {
            $linha->status = 0;
        }
        $linha->update();
        
        return 'Linha inativado com sucesso!';
    }


    public function duplicate(Request $request)
    {
        $sku = CorReferencia::create($request->except('id'));
        $itens = Ficha::where('cor_referencia_id', $request->id)->get();

        foreach($itens as $item) {
            Ficha::create([
                'sequencia' => $item->sequencia,
                'material_id' => $item->material_id,
                'consumo' => $item->consumo,
                'cor_referencia_id' => $sku->id
            ]);
        }

        return redirect('/fichas'.'/'.$sku->id)->with(['success' => 'Ficha duplicada com sucesso!']);


    }
}
