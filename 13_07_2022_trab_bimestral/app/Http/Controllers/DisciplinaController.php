<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Disciplina_Professor;
use App\Facades\UserPermissions;

$GLOBALS['regras'] = [
    'nome' => 'required|max:100|min:10',
    'carga' => 'required|max:12|min:1',
    'curso_id' => 'required'
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 100 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 10 caracteres!",
    "carga.required" => "O preenchimento do campo CARGA é obrigatório!",
    "carga.max" => "O campo CARGA possui tamanho máxixo de 12 dígitos!",
    "carga.min" => "O campo CARGA possui tamanho mínimo de 1 dígitos!",
    "curso_id.required" => "O preenchimento do campo CURSO é obrigatório!",
];

class DisciplinaController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Disciplina::class, 'disciplina');
    }

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
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

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

    public function edit(Disciplina $disciplina)
    {
        $cursos = Curso::all();

        return view('disciplinas.edit', compact(['disciplina','cursos']));
    }

    public function update(Request $request, Disciplina $disciplina)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $disciplina->update([
            "nome" => mb_strtoupper($request->nome),
            "carga" => $request->carga,
            "curso_id" => $request->curso_id
        ]);

        return redirect()->route('disciplinas.index');
    }

    public function destroy(Disciplina $disciplina)
    {
        try 
        {
            $disciplina_professors = Disciplina_Professor::all();
            foreach($disciplina_professors as $item) {
                if($disciplina->id == $item->disciplina_id) {
                    $aux = Disciplina_Professor::find($item->id);
                    $aux->delete();
                }
            }

            $disciplina->delete();

        } catch(\Illuminate\Database\QueryException $ex)
        { 
            $mensagem = $ex->getMessage(); 
        }

        return redirect()->route('disciplinas.index');
    }
}
