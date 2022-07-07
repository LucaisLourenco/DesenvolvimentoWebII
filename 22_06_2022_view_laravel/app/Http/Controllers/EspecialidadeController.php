<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidade;

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
