<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veterinario;
use App\Models\Especialidade;

$GLOBALS['regras'] = [
    'nome' => 'required|max:100|min:10',
    'crmv' => 'required|max:10|min:5|unique:veterinarios',
    'especialidade_id' => 'required'
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 100 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 10 caracteres!",
    "crmv.required" => "O preenchimento do campo CRMV é obrigatório!",
    "crmv.max" => "O campo CRMV possui tamanho máxixo de 10 números!",
    "crmv.min" => "O campo CRMV possui tamanho mínimo de 5 números!",
    "crmv.unique" => "O CRMV informado já existe!",
    "especialidade_id.required" => "O preenchimento do campo ESPECIALIDADE é obrigatório!"
];

class VeterinarioController extends Controller {
    
    public function index() {
        
        $dados = Veterinario::all();
        $esp = Especialidade::all();
        $clinica = "VetClin DWII";

        return view('veterinarios.index', compact(['dados', 'clinica', 'esp']));
    }

    public function create() {

        $esp = Especialidade::all();

        return view('veterinarios.create', compact(['esp']));
    }

   public function store(Request $request) {

    $request->validate($GLOBALS['regras'], $GLOBALS['mensagem']);

    $dados = Especialidade::find($request->especialidade_id);
    
        Veterinario::create([
            "crmv" => $request->crmv,
            "nome" => mb_strtoupper($request->nome),
            "especialidade_id" => $dados->id
        ]);

        return redirect()->route('veterinarios.index');
    }

    public function show($id) {
        
        $aux = Veterinarios::all();
        
        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];

        return view('veterinarios.show', compact('dados'));
    }

    public function edit($id) {

        $dados = Veterinario::find($id);
        $esp = Especialidade::all();

        return view('veterinarios.edit', compact('dados', 'esp'));        
    }

    public function update(Request $request, $id) {

        $aux_regras = [
            'nome' => 'required|max:100|min:10',
            'crmv' => 'required|max:10|min:5',
            'especialidade_id' => 'required'
        ];

        $request->validate($aux_regras, $GLOBALS['mensagem']);

        $novo = Veterinario::find($id);

        $novo->update([
            "crmv" => $request->crmv,
            "nome" => mb_strtoupper($request->nome),
            "especialidade_id" => $request->especialidade_id
        ]);

        return redirect()->route('veterinarios.index');
    }

    public function destroy($id) {

        $Veterinario = Veterinario::find($id);
        $Veterinario->delete();

        return redirect()->route('veterinarios.index');
    }
}