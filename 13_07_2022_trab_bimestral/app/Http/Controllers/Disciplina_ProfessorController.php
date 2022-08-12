<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina_Professor;
use App\Models\Disciplina;
use App\Models\Professor;
use App\Facades\UserPermissions;

class Disciplina_ProfessorController extends Controller
{
    public function index()
    {
        if(!UserPermissions::isAuthorized('cursos.index')) {
            return view('acessonegado.index');
        }

        $disciplina_professors = Disciplina_Professor::all();
        $disciplina = Disciplina::all();
        $professor = Professor::all();

        return view('disciplina_professors.index', compact(['disciplina_professors','disciplina','professor']));
    }

    public function create()
    {
        if(!UserPermissions::isAuthorized('cursos.index')) {
            return view('acessonegado.index');
        }

        $disciplina = Disciplina::all();
        $disciplina_professors = Disciplina_Professor::all();

        foreach($disciplina as $dados) {

            $aux = 0;

            foreach($disciplina_professors as $item) {
                if($dados->id == $item->disciplina_id) {
                    $aux++;
                } 
            }

            if($aux == 0) {
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
        if(!UserPermissions::isAuthorized('cursos.index')) {
            return view('acessonegado.index');
        }

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

    public function destroy($id)
    {
        $disciplina_professors = Disciplina_professor::find($id);

        $disciplina_professors->delete();

        return redirect()->route('disciplina_professors.index');
    }
}
