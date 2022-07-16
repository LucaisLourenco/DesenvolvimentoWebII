<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina_Professor;
use App\Models\Disciplina;
use App\Models\Professor;

class Disciplina_ProfessorController extends Controller
{
    public function index()
    {
        $disciplina_professors = Disciplina_Professor::all();
        $disciplina = Disciplina::all();
        $professor = Professor::all();

        return view('disciplina_professors.index', compact(['disciplina_professors','disciplina','professor']));
    }

    public function create()
    {
        $disciplina = Disciplina::all();

        foreach($disciplina as $dados) {
            
            $aux = Disciplina_Professor::find($dados->id);

            if($aux == null) {
                Disciplina_professor::create([
                    "disciplina_id" => $dados->id,
                    "professor_id" => null
                ]);
            } 
        }

        return redirect()->route('disciplina_professors.index');
    }

    public function store(Request $request)
    {
        $professores = [];
        $disciplinas = [];
        $id = [];

        $count = 0;

        foreach($request->professor_id as $dados) {
              $professores[$count] = $dados;
              $count++;
        }

        $count = 0;

        foreach($request->disciplina_id as $dados) {
            $disciplinas[$count] = $dados;
            $count++;
        }

        $count = 0;

        foreach($request->id as $dados) {
            $id[$count] = $dados;
            $count++;
        }

        for($contador = 0; $contador < $count; $contador++) {
            $new_disciplina_professor = Disciplina_Professor::find($id[$contador]);

            $new_disciplina_professor->update([
                "professor_id" => $professores[$contador],
                "disciplina_id" => $disciplinas[$contador]
            ]);
        } 

        return redirect()->route('disciplina_professors.index');
    }

    public function show($id)
    {
        $disciplina_professor = Disciplina_Professor::find($id);

        return view('disciplina_professors.show', compact(['disciplina_professor']));
    }

    public function edit($id)
    {
        $disciplina_professor = Disciplina_Professor::find($id);

        return view('disciplina_professors.edit', compact(['disciplina_professor']));
    }

    public function update(Request $request, $id)
    {
        $new_disciplina_professor = Disciplina_Professor::find($id);

        $new_disciplina_professor->update([
            "professor_id" => $request->professor_id,
            "disciplina_id" => $request->disciplina_id
        ]);

        return redirect()->route('disciplina_professors.index');
    }

    public function destroy($id)
    {
        $disciplina_professor = Disciplina_Professor::find($id);

        $disciplina_professor->delete();

        return redirect()->route('disciplina_professors.index');
    }
}
