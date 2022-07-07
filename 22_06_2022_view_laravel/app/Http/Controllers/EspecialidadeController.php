<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidade;

$GLOBALS['regras'] = [
    'nome' => 'required|max:100|min:10',
    'descricao' => 'required|max:250|min:20',
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 100 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 10 caracteres!",
    "descricao.required" => "O preenchimento do campo DESCRIÇÃO é obrigatório!",
    "descricao.max" => "O campo DESCRIÇÃO possui tamanho máxixo de 250 caracteres!",
    "descricao.min" => "O campo DESCRIÇÃO possui tamanho mínimo de 20 caracteres!"
];

class EspecialidadeController extends Controller {
    
    public function index() {
        
        $dados = Especialidade::all();
        $clinica = "VetClin DWII";

        return view('especialidades.index', compact(['dados', 'clinica']));
    }

    public function create() {

        return view('especialidades.create');
    }

   public function store(Request $request) {

        $request->validate($GLOBALS['regras'], $GLOBALS['mensagem']);
        
        Especialidade::create([
            "nome" => mb_strtoupper($request->nome),
            "descricao" => $request->descricao
        ]);

        return redirect()->route('especialidades.index');
    }

    public function show($id) {
        
        $aux = Especialidades::all();
        
        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];

        return view('especialidades.show', compact('dados'));
    }

    public function edit($id) {

        $dados = Especialidade::find($id);

        return view('especialidades.edit', compact('dados'));        
    }

    public function update(Request $request, $id) {

        $request->validate($GLOBALS['regras'], $GLOBALS['mensagem']);

        $novo = Especialidade::find($id);

        $novo->update([
            "nome" => $request->nome,
            "descricao" => $request->descricao]);

        return redirect()->route('especialidades.index');
    }

    public function destroy($id) {

        $especialidade = Especialidade::find($id);
        $especialidade->delete();

        return redirect()->route('especialidades.index');
    }
}
