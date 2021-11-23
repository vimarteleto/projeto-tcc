<?php

namespace App\Http\Controllers\FichaTecnica;

use App\Http\Controllers\Controller;
use App\Models\FichaTecnica\Referencia;
use Illuminate\Http\Request;

class ReferenciaController extends Controller
{
    
    public function index()
    {
        $referencias = Referencia::with('cores')->where('status', 1)->orderBy('codigo')->get();
        return $referencias->toJson();        
    }

    public function store(Request $request)
    {
        if(isset($request->id)) {
            $referencia = Referencia::find($request->id);
            $referencia->update($request->all());
            return redirect('/referencias')->with(['warning' => 'Referência atualizada com sucesso!']);

        } else {
            Referencia::create($request->all());
            return redirect('/referencias')->with(['success' => 'Referência cadastrada com sucesso!']);
        }
    }

    public function show($id)
    {
        $referencia = Referencia::with('linha')->with('cores')->find($id);
        return $referencia->toJson();  
    }

    public function destroy(Request $request)
    {
        $referencia = Referencia::find($request->id);
        if (isset($referencia)) {
            $referencia->delete();
        }
        return redirect('/referencias')->with(['danger' => 'Referência excluída com sucesso!']);
    }

    /////////////////////////////////////////////

    public function view()
    {
        $referencias = Referencia::with('linha')
            ->whereRelation('linha', 'status', 1)
        // ->paginate(10);
        ->get();

        return view('ficha.referencias', compact('referencias'));

    }

    // alteracao de status
    public function status($id)
    {
        $linha = Referencia::find($id);

        if ($linha->status == 0){
            $linha->status = 1;
        } else {
            $linha->status = 0;
        }
        $linha->update();
        
        return 'Referencia inativado com sucesso!';
    }
}
