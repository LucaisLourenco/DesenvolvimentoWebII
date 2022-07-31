<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatriculaController;

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
    return view('templates.main')->with('titulo');
})->name('index');

Route::resource('eixos', 'EixoController');
Route::resource('cursos', 'CursoController');
Route::resource('disciplinas', 'DisciplinaController');
Route::resource('professores', 'ProfessorController');
Route::resource('disciplina_professors', 'Disciplina_ProfessorController');
Route::resource('alunos', 'AlunoController');
Route::resource('matriculas', 'MatriculaController');
Route::get('/listar/{id}', [MatriculaController::class, 'listar'])->name('matriculas.listar');
Route::get('/gravar/{id}', [MatriculaController::class, 'gravar'])->name('matriculas.gravar');