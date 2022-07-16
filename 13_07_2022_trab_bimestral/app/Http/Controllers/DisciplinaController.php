<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Curso;

class DisciplinaController extends Controller
{
    public function index()
    {
        $disciplinas = Disciplina::all();
        $cursos = Curso::all();

        return view('disciplinas.index', compact(['disciplinas','cursos']));
    }

    public function create()
    {
        $cursos = Curso::all();

        return view('disciplinas.create', compact(['cursos']));
    }

    public function store(Request $request)
    {
        Disciplina::create([
            "nome" => mb_strtoupper($request->nome),
            "carga" => $request->carga,
            "curso_id" => $request->curso_id
        ]);

        return redirect()->route('disciplinas.index');
    }

    public function show($id)
    {
        $disciplina = Disciplina::find($id);

        return view('disciplinas.show', compact(['disciplina']));
    }

    public function edit($id)
    {
        $disciplina = Disciplina::find($id);
        $cursos = Curso::all();

        return view('disciplinas.edit', compact(['disciplina','cursos']));
    }

    public function update(Request $request, $id)
    {
        $new_disciplina = Disciplina::find($id);

        $new_disciplina->update([
            "nome" => mb_strtoupper($request->nome),
            "carga" => $request->carga,
            "curso_id" => $request->curso_id
        ]);

        return redirect()->route('disciplinas.index');
    }

    public function destroy($id)
    {
        try {
            $disciplina = Disciplina::find($id);

            $disciplina->delete();
        } catch(\Illuminate\Database\QueryException $ex){ 
            $mensagem = $ex->getMessage(); 
        }

        return redirect()->route('disciplinas.index');
    }
}
