<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

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
