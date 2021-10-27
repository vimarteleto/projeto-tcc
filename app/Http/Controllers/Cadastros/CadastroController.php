<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;
use App\Models\Cadastros\Cadastros;
use Illuminate\Http\Request;

class CadastroController extends Controller
{
    
    public function index()
    {
        $cadastros = Cadastros::all();
        return $cadastros->toJson();        
    }

    public function store(Request $request)
    {
        if($request->getMethod() == 'POST') {
            Cadastros::create($request->all());
            return redirect()->back()->with(['success' => 'Cadastro realizado com sucesso!']);

        } else {
            $cadastro = Cadastros::find($request->id);
            $cadastro->update($request->all());
            return redirect()->back()->with(['warning' => 'Cadastros atualizado com sucesso!']);
        }
    }

    public function show($id)
    {
        $cadastro = Cadastros::with('material')->find($id);
        return $cadastro->toJson();  
    }

    public function destroy(Request $request)
    {
        $cadastro = Cadastros::find($request->id);
        if (isset($cadastro)) {
            $cadastro->delete();
        }
        return redirect()->back()->with(['danger' => 'Item excluído com sucesso!']);
    }

    /////////////////////////////////////////////

    public function view()
    {
        $cadastros = Cadastros::all();
            // ->whereRelation('linha', 'status', 1)
        // ->paginate(10);
        // ->get();

        return view('cadastros.cadastros', compact('cadastros'));

    }

    // alteracao de status
    public function status($id)
    {
        $cadastro = Cadastros::find($id);

        if ($cadastro->status == 0){
            $cadastro->status = 1;
        } else {
            $cadastro->status = 0;
        }
        $cadastro->update();
        
        return 'Cadastro inativado com sucesso!';
    }
}
