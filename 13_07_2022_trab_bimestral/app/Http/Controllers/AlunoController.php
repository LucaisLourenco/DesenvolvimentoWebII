<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Curso;
use App\Facades\UserPermissions;

class AlunoController extends Controller
{
   
    public function index()
    {
        if(!UserPermissions::isAuthorized('alunos.index')) {
            return view('acessonegado.index');
        }

        $alunos = Aluno::with(['curso'])->get();
        $alunos->toJson();

        return view('alunos.index', compact(['alunos']));
    }

    public function create()
    {
        if(!UserPermissions::isAuthorized('alunos.create')) {
            return view('acessonegado.index');
        }

        $cursos = Curso::all();

        return view('alunos.create', compact(['cursos']));
    }

    public function store(Request $request)
    {
        if(!UserPermissions::isAuthorized('alunos.create')) {
            return view('acessonegado.index');
        }

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

    public function edit($id)
    {
        if(!UserPermissions::isAuthorized('alunos.edit')) {
            return view('acessonegado.index');
        }

        $aluno = Aluno::find($id);
        $cursos = Curso::all();

        return view('alunos.edit', compact(['aluno','cursos']));
    }

    public function update(Request $request, $id)
    {
        if(!UserPermissions::isAuthorized('alunos.edit')) {
            return view('acessonegado.index');
        }

        $new_aluno = Aluno::find($id);

        $new_aluno->update([
            "nome" => mb_strtoupper($request->nome),
            "curso_id" => $request->curso_id
        ]);

        return redirect()->route('alunos.index');
    }


    public function destroy($id)
    {
        if(!UserPermissions::isAuthorized('alunos.destroy')) {
            return view('acessonegado.index');
        }

        try 
        {    
            $aluno = Aluno::find($id);
            $aluno->delete();

        }   catch(\Illuminate\Database\QueryException $ex)
        { 
            $mensagem = $ex->getMessage(); 
        }

        return redirect()->route('alunos.index');
    }
}
