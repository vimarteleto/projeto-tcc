<?php

namespace App\Http\Controllers\Pedidos;

use App\Http\Controllers\Controller;
use App\Models\Estoque\Estoque;
use App\Models\FichaTecnica\CorReferencia;
use App\Models\FichaTecnica\Ficha;
use App\Models\Materiais\Grade;
use App\Models\Pedidos\MaterialPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MaterialPedidoController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        foreach($request->item as $numero_item => $item) {
            $sku = CorReferencia::where('cor_id', $item['cor'])->where('referencia_id', $item['referencia'])->first();
            
            $materiaisFicha = Ficha::where('cor_referencia_id', $sku->id)->get();
            // dd($materiaisFicha);
            $estoques = Estoque::whereIn('material_id', $materiaisFicha->pluck('material_id'))->get();
            // dd($estoques);
            
            // dd($estoques);
            // dd($materiaisFicha->where('material_id', 1)->first()->consumo);

            foreach($estoques as $estoque) {
                if(isset($estoque->grade_id)) {
                    if($estoque->grade_id == 2) {

                        if(str_contains($estoque->descricao, '37/8')) {
                            $consumo = $item['numero_37'] + $item['numero_38'];
                        } elseif(str_contains($estoque->descricao, '39/0')) {
                            $consumo = $item['numero_39'] + $item['numero_40'];
                        } elseif(str_contains($estoque->descricao, '41/2')) {
                            $consumo = $item['numero_41'] + $item['numero_42'];
                        } elseif(str_contains($estoque->descricao, '43/4')) {
                            $consumo = $item['numero_43'] + $item['numero_44'];
                        }
                        if ($consumo > 0) {
                            MaterialPedido::create([
                                'pedido_id' => $request->id,
                                'item_pedido_id' => $numero_item,
                                'material_id' => $estoque->material_id,
                                'material' => $estoque->descricao,
                                'consumo' => $consumo
                            ]);
                        }
                        
                    }
                } else {
                    MaterialPedido::create([
                        'pedido_id' => $request->id,
                        'item_pedido_id' => $numero_item,
                        'material_id' => $estoque->material_id,
                        'material' => $estoque->descricao,
                        'consumo' => $materiaisFicha->where('material_id', $estoque->material_id)->first()->consumo * $item['quantidade']
                    ]);
                }
                
            }
        }
    }
}
