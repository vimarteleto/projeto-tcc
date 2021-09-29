<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use App\Models\Materiais\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    
    public function index()
    {
        $grades = Grade::with('materiais')->get();
        return $grades->toJson();        
    }

    public function store(Request $request)
    {
        if(isset($request->id)) {
            $grade = Grade::find($request->id);
            $grade->update($request->all());
            return redirect('/grades')->with(['warning' => 'Grade atualizada com sucesso!']);

        } else {
            Grade::create($request->all());
            return redirect('/grades')->with(['success' => 'Grade cadastrada com sucesso!']);
        }
        
        return redirect('/grades');
    }

    public function show($id)
    {
        $grade = Grade::with('materiais')->find($id);
        return $grade->toJson();  
    }

    public function destroy(Request $request)
    {
        $grade = Grade::find($request->id);
        if (isset($grade)) {
            $grade->delete();
        }
        return redirect('/grades')->with(['danger' => 'Grade excluída com sucesso!']);
    }

    /////////////////////////////////////////////

    public function view()
    {
        $grades = Grade::with('materiais')->get();
        return view('materiais.grades', compact('grades'));
    }
}
