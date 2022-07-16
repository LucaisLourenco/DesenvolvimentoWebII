<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Eixo;

$GLOBALS['regras'] = [
    'ativo' => 'required',
    'nome' => 'required|max:100|min:10',
    'email' => 'required|max:250|min:15|unique:professors',
    'siape' => 'required|max:10|min:8',
    'eixo_id' => 'required'
];

$GLOBALS['mensagem']= [
    "ativo.required" => "O preenchimento do campo ATIVO é obrigatório!",
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 100 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 10 caracteres!",
    "email.required" => "O preenchimento do campo EMAIL é obrigatório!",
    "email.max" => "O campo EMAIL possui tamanho máxixo de 250 caracteres!",
    "email.min" => "O campo EMAIL possui tamanho mínimo de 15 caracteres!",
    "siape.required" => "O preenchimento do campo SIAPE é obrigatório!",
    "siape.max" => "O campo SIAPE possui tamanho máxixo de 10 dígitos!",
    "siape.min" => "O campo SIAPE possui tamanho mínimo de 8 dígito!",
    "eixo_id.required" => "O preenchimento do campo EIXO é obrigatório!"
];

class ProfessorController extends Controller
{
    public function index()
    {
        $professores = Professor::all();
        $eixos = Eixo::all();

        return view('professores.index', compact(['professores','eixos']));
    }

    public function create()
    {
        $eixos = Eixo::all();

        return view('professores.create', compact(['eixos']));
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        Professor::create([
            "nome" => mb_strtoupper($request->nome),
            "email" => $request->email,
            "siape" => $request->siape,
            "eixo_id" => $request->eixo_id,
            "ativo" => $request->ativo
        ]);

        return redirect()->route('professores.index');
    }

    public function show($id)
    {
        $professor = Professor::find($id);

        return view('professores.show', compact(['professor']));
    }

    public function edit($id)
    {
        $professor = Professor::find($id);
        $eixos = Eixo::all();

        return view('professores.edit', compact(['professor','eixos']));
    }

    public function update(Request $request, $id)
    {
        $regras['regras'] = [
            'ativo' => 'required',
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15',
            'siape' => 'required|max:10|min:8',
            'eixo_id' => 'required'
        ];

        $request->validate($regras['regras'],$GLOBALS['mensagem']);

        $new_professor = Professor::find($id);

        $new_professor->update([
            "nome" => mb_strtoupper($request->nome),
            "email" => $request->email,
            "siape" => $request->siape,
            "eixo_id" => $request->eixo_id,
            "ativo" => $request->ativo
        ]);

        return redirect()->route('professores.index');
    }

    public function destroy($id)
    {
        $professor = Professor::find($id);

        $professor->delete();

        return redirect()->route('professores.index');
    }        
}
