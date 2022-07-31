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
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $alunos = Aluno::find($id);
        dd($alunos);
        //$alunos = Aluno::with(['curso'])->get();
        //$alunos->toJson();

       // return view('disciplina_alunos.index', compact(['alunos']));
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

    public function matriculas($id)
    {
     //   $aluno = Matricula::with(['aluno'])->get();
   //     $aluno = toJson();
        
        echo "teste";
    }
}
