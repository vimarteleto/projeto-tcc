<?php

namespace App\Http\Controllers\FichaTecnica;

use App\Http\Controllers\Controller;
use App\Models\FichaTecnica\Referencia;
use Illuminate\Http\Request;

class ReferenciaController extends Controller
{
    
    public function index()
    {
        $referencias = Referencia::all();
        return $referencias->toJson();        
    }

    public function store(Request $request)
    {
        if(isset($request->id)) {
            $referencia = Referencia::find($request->id);
            $referencia->update($request->all());
            return redirect('/referencias')->with(['warning' => 'Referencia atualizada com sucesso!']);

        } else {
            Referencia::create($request->all());
            return redirect('/referencias')->with(['success' => 'Referencia cadastrada com sucesso!']);
        }
    }

    public function show($id)
    {
        $referencia = Referencia::find($id);
        return $referencia->toJson();  
    }

    public function destroy(Request $request)
    {
        $referencia = Referencia::find($request->id);
        if (isset($referencia)) {
            $referencia->delete();
        }
        return redirect('/referencias')->with(['danger' => 'Referencia excluída com sucesso!']);
    }

    /////////////////////////////////////////////

    public function view()
    {
        $referencias = Referencia::all();
        return view('ficha.referencias', compact('referencias'));
    }
}
