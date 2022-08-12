<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Eixo;
use App\Facades\UserPermissions;

$GLOBALS['regras'] = [
    'nome' => 'required|max:50|min:10',
    'sigla' => 'required|max:8|min:2',
    'tempo' => 'required|max:2|min:1',
    'eixo_id' => 'required'
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 50 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 10 caracteres!",
    "sigla.required" => "O preenchimento do campo SIGLA é obrigatório!",
    "sigla.max" => "O campo SIGLA possui tamanho máxixo de 8 caracteres!",
    "sigla.min" => "O campo SIGLA possui tamanho mínimo de 2 caracteres!",
    "tempo.required" => "O preenchimento do campo TEMPO é obrigatório!",
    "tempo.max" => "O campo TEMPO possui tamanho máxixo de 2 dígitos!",
    "tempo.min" => "O campo TEMPO possui tamanho mínimo de 1 dígito!",
    "eixo_id.required" => "O preenchimento do campo EIXO é obrigatório!"
];

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        $eixos = Eixo::all();

        if(!UserPermissions::isAuthorized('cursos.index')) {
            abort(403);
        }

        return view('cursos.index', compact(['cursos','eixos']));
    }

    public function create()
    {
        $eixos = Eixo::all();

        return view('cursos.create', compact(['eixos']));
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        Curso::create([
            "nome" => mb_strtoupper($request->nome),
            "sigla" => $request->sigla,
            "tempo" => $request->tempo,
            "eixo_id" => $request->eixo_id
        ]);

        return redirect()->route('cursos.index');
    }

    public function show($id)
    {
        $curso = Curso::find($id);

        return view('cursos.show', compact(['curso']));
    }

    public function edit($id)
    {
        $curso = Curso::find($id);
        $eixos = Eixo::all();

        return view('cursos.edit', compact(['curso','eixos']));
    }

    public function update(Request $request, $id)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $new_curso = Curso::find($id);

        $new_curso->update([
            "nome" => mb_strtoupper($request->nome),
            "sigla" => $request->sigla,
            "tempo" => $request->tempo,
            "eixo_id" => $request->eixo_id
        ]);

        return redirect()->route('cursos.index');
    }

    public function destroy($id)
    {
        try 
        {    
            $curso = Curso::find($id);
            $curso->delete();

        }   catch(\Illuminate\Database\QueryException $ex)
        { 
            $mensagem = $ex->getMessage(); 
        }

        return redirect()->route('cursos.index');
    }
}
