<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use App\Models\Estoque\Estoque;
use App\Models\Materiais\Material;
use Illuminate\Http\Request;

class MateriaisController extends Controller
{
    // retorna um index com todos os itens, incluindo relacionamentos
    public function index()
    {
        $materiais = Material::with('categoria', 'unidade', 'grade')->get();
        return $materiais->toJson();        
    }

    // cria novos registros ou atualiza registros existentes
    public function store(Request $request)
    {
        if(isset($request->id)) {
            $material = Material::with('grade')->find($request->id);
            $nome = $material->nome;
            $material->update($request->all());

            if(
                ($material->grade == null && $request->grade_id != null) || 
                ($material->grade != null && $request->grade_id == null)
            ) {
                Estoque::where('material_id', $material->id)->delete();
                $this->estoques($material->id);

            } elseif($material->grade == null && $request->grade_id == null) {
                $estoque = Estoque::where('material_id', $material->id)->first();
                $estoque->update([
                    'material' => $request->nome,
                ]);
                
            } elseif ($material->grade->id == $request->grade_id) {                
                
                if($nome != $request->nome) {                    
                    
                    $grades = collect($material->grade);
    
                    unset($grades['id']);
                    unset($grades['created_at']);
                    unset($grades['updated_at']);
                    $grades = $grades->whereNotNull()->unique()->values();

                    if(count($grades) > 0) {
                        foreach($grades as $grade) {
                            $estoque = Estoque::where('material_id', $material->id)
                                ->where('material', 'like', '%'.$grade)
                            ->first();

                            $estoque->update([
                                'material' => $request->nome . ' ' . $grade,
                            ]);
                        }
                    }
                }
                
            } else {
                Estoque::where('material_id', $material->id)->delete();
                $this->estoques($material->id);
            }
            
            return redirect('/materiais')->with(['warning' => 'Material atualizado com sucesso!']);

        } else {
            $material = Material::create($request->all()); 
            
            $this->estoques($material->id);

            return redirect('/materiais')->with(['success' => 'Material cadastrado com sucesso!']);
        }
        
        return redirect('/materiais');
    }

    // retorna um registro em especifico, incluindo relacionamentos
    public function show($id)
    {
        $material = Material::where('id',$id)->with('categoria', 'unidade', 'grade')->first();
        return $material->toJson();  
    }

    // deleta um registro
    public function destroy(Request $request)
    {
        $material = Material::find($request->id);
        if (isset($material)) {
            $material->delete();
        }
        return redirect('/materiais')->with(['danger' => 'Material excluído com sucesso!']);
    }

    // retorna a view principal do crud do item, com relacionamentos e ordenado
    public function view()
    {
        $materiais = Material::with('categoria', 'unidade', 'grade')->orderBy('categoria_id')->get();
        return view('materiais.materiais', compact('materiais'));
    }

    // alteracao de status
    public function status($id)
    {
        $material = Material::find($id);

        if ($material->status == 0){
            $material->status = 1;
        } else {
            $material->status = 0;
        }
        $material->update();
        
        return 'Material inativado com sucesso!';
    }

    // criacao e alteracao na tabela de estoques
    public function estoques($id)
    {
        $material = Material::find($id);

        $grades = collect($material->grade);
        if(isset($grades['id'])) {
            $grade_id = $grades['id'];
        }
        unset($grades['id']);
        unset($grades['created_at']);
        unset($grades['updated_at']);
        $grades = $grades->whereNotNull()->unique()->values();

        if(count($grades) > 0) {
            foreach($grades as $grade) {
                Estoque::create([
                    'material_id' => $material->id,
                    'descricao' => $material->nome . ' ' . $grade,
                    'grade_id' => $grade_id,
                    'quantidade' => '0'
                ]);
            }
        } else {
            Estoque::create([
                'material_id' => $material->id,
                'descricao' => $material->nome,
                'quantidade' => '0'
            ]);
        }
    }
}
