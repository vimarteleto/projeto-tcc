<?php

use App\Http\Controllers\Materiais\CategoriaController;
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
Route::get('/categorias/excluir/{id}', [CategoriaController::class, 'destroy']);
Route::post('/categorias/editar/{id}', [CategoriaController::class, 'update']);
// Route::get('/categorias/editar/{id}', [CategoriaController::class, 'edit']);
// Route::post('/categorias/novo', [CategoriaController::class, 'create']);


