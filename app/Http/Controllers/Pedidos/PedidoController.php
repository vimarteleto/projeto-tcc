<?php

namespace App\Http\Controllers\Pedidos;

use App\Http\Controllers\Controller;
use App\Models\FichaTecnica\CorReferencia;
use App\Models\Pedidos\ItemPedido;
use App\Models\Pedidos\MaterialPedido;
use App\Models\Pedidos\Pedido;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    
    public function index()
    {
        $pedidos = Pedido::all();
        return $pedidos->toJson();        
    }

    public function store(Request $request)
    {
        $total_valor = 0;
        $total_pares = 0;
        foreach($request->item as $item) {
            $total_pares += $item['quantidade'];
            $total_valor += $item['quantidade'] * $item['preco'];
        }
        if($request->getMethod() == 'POST') {
            DB::beginTransaction();
            try {
                Pedido::create([
                    'pedido_cliente' => $request->pedido_cliente ?? $request->id,
                    'cliente_id' => $request->cliente_id,
                    'representante_id' => $request->representante_id,
                    'marca' => $request->marca,
                    'data_entrega' => $request->data_entrega,
                    'condicao_pagamento' => $request->condicao_pagamento,
                    'transportador_id' => $request->transportador_id,
                    'frete' => $request->frete,
                    'volumes' => $request->volumes,
                    'peso_liquido' => $request->peso_liquido,
                    'peso_bruto' => $request->peso_bruto,
                    'total_valor' => $total_valor,
                    'total_pares' => $total_pares,
                    'situacao' => 'N',
                    'observacoes' => $request->observacoes ?? 'Sem observações'
                ]);
    
                foreach($request->item as $numero_item => $item) {
                    $sku = CorReferencia::where('cor_id', $item['cor'])->where('referencia_id', $item['referencia'])->first();
                    ItemPedido::create([
                        'pedido_id' => $request->id,
                        'item' => $numero_item,
                        'cor_referencia_id' => $sku->id,
                        'numero_34' => $item['numero_34'],
                        'numero_35' => $item['numero_35'],
                        'numero_36' => $item['numero_36'],
                        'numero_37' => $item['numero_37'],
                        'numero_38' => $item['numero_38'],
                        'numero_39' => $item['numero_39'],
                        'numero_40' => $item['numero_40'],
                        'numero_41' => $item['numero_41'],
                        'numero_42' => $item['numero_42'],
                        'numero_43' => $item['numero_43'],
                        'numero_44' => $item['numero_44'],
                        'numero_45' => $item['numero_45'],
                        'quantidade' => $item['quantidade'],
                        'preco' => $item['preco'],
                        'desconto' => $item['desconto'],
                        'total' => ($item['preco'] - ($item['desconto'] * 0.01 * $item['preco'])) * $item['quantidade']
                    ]);
                }
                (new MaterialPedidoController)->store($request);
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                Log::info($e->getMessage());
                return redirect()->back()->with(['danger' => 'Erro ao cadastrar pedido!']);
            }
            
            return redirect()->back()->with(['success' => 'Pedido cadastrado com sucesso!']);
        }//  else {
        //     $pedido = Pedido::find($request->id);
        //     $pedido->update($request->all());
        //     return redirect()->back()->with(['warning' => 'Pedido atualizado com sucesso!']);
        // }
    }

    public function show($id)
    {
        $pedido = Pedido::find($id);
        return $pedido->toJson();  
    }

    public function destroy(Request $request)
    {
        $pedido = Pedido::find($request->id);
        
        if (isset($pedido)) {
            $itens = ItemPedido::where('pedido_id', $request->id)->get();
            DB::beginTransaction();
            try {
                foreach($itens as $item) {
                    $item->delete();
                }
                $pedido->delete();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                Log::info($e->getMessage());
                return redirect()->back()->with(['danger' => 'Erro ao excluir pedido!']);
            }
        }
        return redirect()->back()->with(['danger' => 'Pedido excluído com sucesso!']);
    }

    /////////////////////////////////////////////

    public function view()
    {
        


        $pedidos = Pedido::all();
        $proximoId = DB::table('pedidos')->max('id') + 1;
        return view('pedidos.pedidos', compact('pedidos', 'proximoId'));

    }

    public function explosao($id)
    {
        $explosao = MaterialPedido::where('pedido_id', $id)
            ->selectRaw("material, SUM(consumo) as consumo")
            ->groupBy('material')
            ->orderBy('material')
        ->get();

        return $explosao->toJson();   
    }

    // alteracao de status
    // public function status($id)
    // {
    //     $pedido = Pedido::find($id);

    //     if ($pedido->status == 0){
    //         $pedido->status = 1;
    //     } else {
    //         $pedido->status = 0;
    //     }
    //     $pedido->update();
        
    //     return 'Cadastro inativado com sucesso!';
    // }
}
