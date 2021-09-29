<?php

use App\Http\Controllers\Estoque\EstoqueController;
use App\Http\Controllers\Materiais\CategoriaController;
use App\Http\Controllers\Materiais\GradeController;
use App\Http\Controllers\Materiais\MateriaisController;
use App\Http\Controllers\Materiais\UnidadeController;
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