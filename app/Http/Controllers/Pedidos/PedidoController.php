<?php

namespace App\Http\Controllers\Pedidos;

use App\Http\Controllers\Controller;
use App\Models\Pedidos\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    
    public function index()
    {
        $pedidos = Pedido::all();
        return $pedidos->toJson();        
    }

    public function store(Request $request)
    {
        if($request->getMethod() == 'POST') {
            Pedido::create($request->all());
            return redirect()->back()->with(['success' => 'Cadastro realizado com sucesso!']);

        } else {
            $pedido = Pedido::find($request->id);
            $pedido->update($request->all());
            return redirect()->back()->with(['warning' => 'Pedido atualizado com sucesso!']);
        }
    }

    public function show($id)
    {
        $pedido = Pedido::with('material')->find($id);
        return $pedido->toJson();  
    }

    public function destroy(Request $request)
    {
        $pedido = Pedido::find($request->id);
        if (isset($pedido)) {
            $pedido->delete();
        }
        return redirect()->back()->with(['danger' => 'Item excluído com sucesso!']);
    }

    /////////////////////////////////////////////

    public function view()
    {
        $pedidos = Pedido::all();
            // ->whereRelation('linha', 'status', 1)
        // ->paginate(10);
        // ->get();

        return view('pedidos.pedidos', compact('pedidos'));

    }

    // alteracao de status
    public function status($id)
    {
        $pedido = Pedido::find($id);

        if ($pedido->status == 0){
            $pedido->status = 1;
        } else {
            $pedido->status = 0;
        }
        $pedido->update();
        
        return 'Cadastro inativado com sucesso!';
    }
}
