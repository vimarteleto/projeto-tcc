<?php

use App\Http\Controllers\Cadastros\CadastroController;
use App\Http\Controllers\Estoque\EstoqueController;
use App\Http\Controllers\FichaTecnica\CorController;
use App\Http\Controllers\FichaTecnica\CorReferenciaController;
use App\Http\Controllers\FichaTecnica\FichaController;
use App\Http\Controllers\FichaTecnica\LinhaController;
use App\Http\Controllers\FichaTecnica\ReferenciaController;
use App\Http\Controllers\Materiais\CategoriaController;
use App\Http\Controllers\Materiais\GradeController;
use App\Http\Controllers\Materiais\MateriaisController;
use App\Http\Controllers\Materiais\UnidadeController;
use App\Http\Controllers\Pedidos\PedidoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// categorias
Route::get('/categorias', [CategoriaController::class, 'view']); // retorna a view
Route::get('/categorias/index', [CategoriaController::class, 'index']); // retorna um index com todos
Route::post('/categorias', [CategoriaController::class, 'store']); // salva ou atualiza registros
Route::get('/categorias/excluir', [CategoriaController::class, 'destroy']); // deleta registros
Route::get('/categorias/{id}', [CategoriaController::class, 'show']); // busca um registro especifico

// materiais
Route::get('/materiais', [MateriaisController::class, 'view']);
Route::get('/materiais/index', [MateriaisController::class, 'index']);
Route::get('fichas/materiais/index', [MateriaisController::class, 'index']);
Route::post('/materiais', [MateriaisController::class, 'store']);
Route::post('/materiais/status/{id}', [MateriaisController::class, 'status']);
Route::get('/materiais/excluir', [MateriaisController::class, 'destroy']);
Route::get('/materiais/{id}', [MateriaisController::class, 'show']);

// unidades
Route::get('/unidades', [UnidadeController::class, 'view']);
Route::get('/unidades/index', [UnidadeController::class, 'index']);
Route::post('/unidades', [UnidadeController::class, 'store']);
Route::get('/unidades/excluir', [UnidadeController::class, 'destroy']);
Route::get('/unidades/{id}', [UnidadeController::class, 'show']);

// grades
Route::get('/grades', [GradeController::class, 'view']);
Route::get('/grades/index', [GradeController::class, 'index']);
Route::post('/grades', [GradeController::class, 'store']);
Route::get('/grades/excluir', [GradeController::class, 'destroy']);
Route::get('/grades/{id}', [GradeController::class, 'show']);

// estoque
Route::get('/estoques', [EstoqueController::class, 'view']);
Route::post('/estoques', [EstoqueController::class, 'store']);

////////////////////////////////////////////////////////////////

// linhas
Route::get('/linhas', [LinhaController::class, 'view']); 
Route::get('/linhas/index', [LinhaController::class, 'index']); 
Route::post('/linhas', [LinhaController::class, 'store']); 
Route::get('/linhas/excluir', [LinhaController::class, 'destroy']);
Route::get('/linhas/{id}', [LinhaController::class, 'show']); 
Route::post('/linhas/status/{id}', [LinhaController::class, 'status']);

// referencias
Route::get('/referencias', [ReferenciaController::class, 'view']);
Route::get('/referencias/index', [ReferenciaController::class, 'index']); 
Route::post('/referencias', [ReferenciaController::class, 'store']); 
Route::get('/referencias/excluir', [ReferenciaController::class, 'destroy']);
Route::get('/referencias/{id}', [ReferenciaController::class, 'show']);
Route::post('/referencias/status/{id}', [ReferenciaController::class, 'status']);

// cores
Route::get('/cores', [CorController::class, 'view']);
Route::get('/cores/index', [CorController::class, 'index']); 
Route::post('/cores', [CorController::class, 'store']); 
Route::get('/cores/excluir', [CorController::class, 'destroy']);
Route::get('/cores/{id}', [CorController::class, 'show']);
// Route::post('/cores/status/{id}', [CorController::class, 'status']);

// skus
Route::get('/skus', [CorReferenciaController::class, 'view']);
Route::get('/skus/index', [CorReferenciaController::class, 'index']); 
Route::post('/skus', [CorReferenciaController::class, 'store']); 
Route::put('/skus', [CorReferenciaController::class, 'store']); 
Route::get('/skus/excluir', [CorReferenciaController::class, 'destroy']);
Route::post('/skus/status/{id}', [CorReferenciaController::class, 'status']);
Route::post('/skus/duplicate', [CorReferenciaController::class, 'duplicate']);
Route::get('/skus/{id}', [CorReferenciaController::class, 'show']);
Route::get('/skus/{referencia_id}/{cor_id}', [CorReferenciaController::class, 'showByCorReferencia']);

// fichas
Route::get('/fichas/{id}', [FichaController::class, 'view']);
Route::get('/fichas/index', [FichaController::class, 'index']); 
Route::post('/fichas', [FichaController::class, 'store']); 
Route::get('/fichas/fichas/excluir', [FichaController::class, 'destroy']);
Route::get('/fichas/fichas/{id}', [FichaController::class, 'show']);
Route::post('/fichas/status/{id}', [FichaController::class, 'status']);

////////////////////////////////////////////////////////////////

// cadastros
Route::get('/cadastros', [CadastroController::class, 'view']);
Route::get('/cadastros/index/{type?}', [CadastroController::class, 'index']); 
Route::post('/cadastros', [CadastroController::class, 'store']); 
Route::put('/cadastros', [CadastroController::class, 'store']); 
Route::get('/cadastros/cadastros/excluir', [CadastroController::class, 'destroy']);
Route::get('/cadastros/cadastros/{id}', [CadastroController::class, 'show']);
Route::post('/cadastros/status/{id}', [CadastroController::class, 'status']);

// pedidos
Route::get('/pedidos', [PedidoController::class, 'view']);
Route::get('/pedidos/index', [PedidoController::class, 'index']); 
Route::post('/pedidos', [PedidoController::class, 'store']); 
Route::put('/pedidos', [PedidoController::class, 'store']); 
Route::get('/pedidos/excluir', [PedidoController::class, 'destroy']);
Route::get('/pedidos/{id}', [PedidoController::class, 'show']);
Route::post('/pedidos/status/{id}', [PedidoController::class, 'status']);
Route::get('/pedidos/explosao/{id}', [PedidoController::class, 'explosao']);