<?php

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
Route::get('/categorias', [CategoriaController::class, 'view']);
Route::get('/categorias/index', [CategoriaController::class, 'index']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::put('/categorias', [CategoriaController::class, 'update']);
Route::get('/categorias/excluir', [CategoriaController::class, 'destroy']);
Route::get('/categorias/{id}', [CategoriaController::class, 'show']);

// materiais
Route::get('/materiais', [MateriaisController::class, 'view']);
Route::get('/materiais/index', [MateriaisController::class, 'index']);
Route::post('/materiais', [MateriaisController::class, 'store']);
Route::put('/materiais', [MateriaisController::class, 'update']);
Route::get('/materiais/excluir', [MateriaisController::class, 'destroy']);
Route::get('/materiais/{id}', [MateriaisController::class, 'show']);

// unidades
Route::get('/unidades', [UnidadeController::class, 'view']);
Route::get('/unidades/index', [UnidadeController::class, 'index']);
Route::post('/unidades', [UnidadeController::class, 'store']);
Route::put('/unidades', [UnidadeController::class, 'update']);
Route::get('/unidades/excluir', [UnidadeController::class, 'destroy']);
Route::get('/unidades/{id}', [UnidadeController::class, 'show']);

// grades
Route::get('/grades', [GradeController::class, 'view']);
Route::get('/grades/index', [GradeController::class, 'index']);
Route::post('/grades', [GradeController::class, 'store']);
Route::put('/grades', [GradeController::class, 'update']);
Route::get('/grades/excluir', [GradeController::class, 'destroy']);
Route::get('/grades/{id}', [GradeController::class, 'show']);