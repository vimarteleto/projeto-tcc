<?php

namespace App\Http\Controllers\Estoque;

use App\Http\Controllers\Controller;
use App\Models\Estoque\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    // retorna a view principal do crud do item, com relacionamentos e ordenado
    public function view()
    {
        $estoques = Estoque::all();
        return view('estoques.estoques', compact('estoques'));
    }
}
