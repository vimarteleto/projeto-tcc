<?php

namespace App\Http\Controllers\FichaTecnica;

use App\Http\Controllers\Controller;
use App\Models\FichaTecnica\Cor;
use Illuminate\Http\Request;

class CorController extends Controller
{
    
    public function index()
    {
        $cores = Cor::all();
        return $cores->toJson();        
    }

    public function store(Request $request)
    {
        if(isset($request->id)) {
            $cor = Cor::find($request->id);
            $cor->update($request->all());
            return redirect('/cores')->with(['warning' => 'Cor atualizada com sucesso!']);

        } else {
            Cor::create($request->all());
            return redirect('/cores')->with(['success' => 'Cor cadastrada com sucesso!']);
        }
    }

    public function show($id)
    {
        $cor = Cor::find($id);
        return $cor->toJson();  
    }

    public function destroy(Request $request)
    {
        $cor = Cor::find($request->id);
        if (isset($cor)) {
            $cor->delete();
        }
        return redirect('/cores')->with(['danger' => 'Cor excluída com sucesso!']);
    }

    /////////////////////////////////////////////

    public function view()
    {
        $cores = Cor::all();
            // ->whereRelation('linha', 'status', 1)
        // ->paginate(10);
        // ->get();

        return view('ficha.cores', compact('cores'));

    }
}
