<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

$GLOBALS['regras'] = [
    'nome' => 'required|max:100|min:10',
    'email' => 'required|max:150|min:15',
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 100 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 10 caracteres!",
    "email.required" => "O preenchimento do campo E-MAIL é obrigatório!",
    "email.max" => "O campo E-MAIL possui tamanho máxixo de 100 caracteres!",
    "email.min" => "O campo E-MAIL possui tamanho mínimo de 10 caracteres!"
];

class ClienteController extends Controller {
    
    public function index() {
        
        $dados = Cliente::all();
        $clinica = "VetClin DWII";

        return view('clientes.index', compact(['dados', 'clinica']));
    }

    public function create() {

        return view('clientes.create');
    }

   public function store(Request $request) {

        $request->validate($GLOBALS['regras'], $GLOBALS['mensagem']);
    
        Cliente::create([
            "nome" => mb_strtoupper($request->nome),
            "email" => $request->email
        ]);

        return redirect()->route('clientes.index');
    }

    public function show($id) {
        
        $aux = Clientes::all();
        
        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];

        return view('clientes.show', compact('dados'));
    }

    public function edit($id) {

        $dados = Cliente::find($id);

        return view('clientes.edit', compact('dados'));        
    }

    public function update(Request $request, $id) {

        $request->validate($GLOBALS['regras'], $GLOBALS['mensagem']);

        $novo = Cliente::find($id);

        $novo->update([
            "nome" => $request->nome,
            "email" => $request->email]);

        return redirect()->route('clientes.index');
    }

    public function destroy($id) {

        $cliente = Cliente::find($id);
        $cliente->delete();

        return redirect()->route('clientes.index');
    }
}
