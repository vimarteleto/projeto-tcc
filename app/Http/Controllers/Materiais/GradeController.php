<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use App\Models\Materiais\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    
    public function index()
    {
        $grades = Grade::all();
        return $grades->toJson();        
    }

    public function store(Request $request)
    {
        if(isset($request->id)) {
            $material = Grade::find($request->id);
            $material->update($request->all());

        } else {
            Grade::create($request->all());
        }
        
        return redirect('/grades');
    }

    public function show($id)
    {
        $grade = Grade::find($id);
        return $grade->toJson();  
    }


    public function destroy(Request $request)
    {
        $grade = Grade::find($request->id);
        if (isset($grade)) {
            $grade->delete();
        }
        return redirect('/grades');
    }

    /////////////////////////////////////////////

    public function view()
    {
        $grades = Grade::all();
        return view('materiais.grades', compact('grades'));
    }
}
