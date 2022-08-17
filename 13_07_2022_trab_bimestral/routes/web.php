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

Route::resource('eixos', 'EixoController')->middleware(['auth']);

Route::resource('cursos', 'CursoController')->middleware(['auth']);

Route::resource('disciplinas', 'DisciplinaController')->middleware(['auth']);

Route::resource('professores', 'ProfessorController')->middleware(['auth']);

Route::resource('disciplina_professors', 'Disciplina_ProfessorController')->middleware(['auth']);

Route::resource('alunos', 'AlunoController')->middleware(['auth']);

Route::resource('matriculas', 'MatriculaController')->middleware(['auth']);

Route::get('/listar/{id}', [MatriculaController::class, 'listar'])->name('matriculas.listar');

Route::get('/gravar/{id}', [MatriculaController::class, 'gravar'])->name('matriculas.gravar');

Route::get('/', function () {
    return view('templates.main')->with('titulo');
})->middleware(['auth'])->name('index');

require __DIR__.'/auth.php';
