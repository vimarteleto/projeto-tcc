<?php

namespace App\Http\Controllers\FichaTecnica;

use App\Http\Controllers\Controller;
use App\Models\FichaTecnica\Linha;
use Illuminate\Http\Request;

class LinhaController extends Controller
{
    
    public function index()
    {
        $linhas = Linha::where('status', 1)->get();
        return $linhas->toJson();        
    }

    public function store(Request $request)
    {
        if(isset($request->id)) {
            $linha = Linha::find($request->id);
            $linha->update($request->all());
            return redirect('/linhas')->with(['warning' => 'Linha atualizada com sucesso!']);

        } else {
            Linha::create($request->all());
            return redirect('/linhas')->with(['success' => 'Linha cadastrada com sucesso!']);
        }
    }

    public function show($id)
    {
        $linha = Linha::find($id);
        return $linha->toJson();  
    }

    public function destroy(Request $request)
    {
        $linha = Linha::find($request->id);
        if (isset($linha)) {
            $linha->delete();
        }
        return redirect('/linhas')->with(['danger' => 'Linha excluída com sucesso!']);
    }

    /////////////////////////////////////////////

    public function view()
    {
        $linhas = Linha::all();
        return view('ficha.linhas', compact('linhas'));
    }

    // alteracao de status
    public function status($id)
    {
        $linha = Linha::find($id);

        if ($linha->status == 0){
            $linha->status = 1;
        } else {
            $linha->status = 0;
        }
        $linha->update();
        
        return 'Linha inativado com sucesso!';
    }
}

