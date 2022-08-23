<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Curso;
use App\Facades\UserPermissions;

class AlunoController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Aluno::class, 'aluno');
    }

    public function index()
    {
        $alunos = Aluno::with(['curso'])->get();
        $alunos->toJson();

        return view('alunos.index', compact(['alunos']));
    }

    public function create()
    {
        $cursos = Curso::all();

        return view('alunos.create', compact(['cursos']));
    }

    public function store(Request $request)
    {
        $curso = Curso::find($request->curso_id);        
        $aluno = new Aluno();
        $aluno->nome = mb_strtoupper($request->nome);
        $aluno->curso()->associate($curso);
        $aluno->save();

        return redirect()->route('alunos.index');
    }

    public function show($id)
    {
        
    }

    public function edit(Aluno $aluno)
    {
        $cursos = Curso::all();

        return view('alunos.edit', compact(['aluno','cursos']));
    }

    public function update(Request $request, Aluno $aluno)
    {
        $aluno->update([
            "nome" => mb_strtoupper($request->nome),
            "curso_id" => $request->curso_id
        ]);

        return redirect()->route('alunos.index');
    }


    public function destroy(Aluno $aluno)
    {
        try 
        {    
            $aluno->delete();

        }   catch(\Illuminate\Database\QueryException $ex)
        { 
            $mensagem = $ex->getMessage(); 
        }

        return redirect()->route('alunos.index');
    }
}
