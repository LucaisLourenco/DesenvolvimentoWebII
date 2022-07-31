<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Matricula;

class MatriculaController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
       //
    }

    public function store(Request $request)
    {
        $aluno = Aluno::find($request->aluno_id);
        $aluno->disciplina()->detach();

        if(isset($request['disciplina_id'])) {
            foreach($request['disciplina_id'] as $item) {
                $disciplina = Disciplina::find($item);    
                if(isset($disciplina)){
                    $matricula = new Matricula();
                    $matricula->aluno()->associate($aluno);
                    $matricula->disciplina()->associate($disciplina);
                    $matricula->save();
                }
            }
        }
        
        return view('matriculas.listar', compact(['aluno']));
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function listar($id) {
        $aluno = Aluno::with(['disciplina'])->get()->find($id);
        $aluno->toJson();

        return view('matriculas.listar', compact(['aluno']));
    }

    public function gravar($id) 
    {
        $disciplinas = Disciplina::all();
        $aluno = Aluno::with(['disciplina'])->get()->find($id);

        return view('matriculas.gravar', compact(['disciplinas','aluno']));
    }
}
