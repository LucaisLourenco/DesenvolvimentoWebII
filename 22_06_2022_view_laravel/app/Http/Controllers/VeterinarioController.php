<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veterinario;
use App\Models\Especialidade;

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

    $dados = Especialidade::find($request->especialidade);
        
    print_r($dados);
    
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

        $novo = Veterinario::find($id);

        $novo->update([
            "crmv" => $request->crmv,
            "nome" => mb_strtoupper($request->nome),
            "especialidade_id" => $request->especialidade
        ]);

        return redirect()->route('veterinarios.index');
    }

    public function destroy($id) {

        $Veterinario = Veterinario::find($id);
        $Veterinario->delete();

        return redirect()->route('veterinarios.index');
    }
}