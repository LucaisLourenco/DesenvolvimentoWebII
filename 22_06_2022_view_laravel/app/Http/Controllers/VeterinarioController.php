<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VeterinarioController extends Controller
{
    public $veterinarios = [[        
        "crmv" => 23245,
        "nome" => "Lucas Gomes Lourenço",
        "especialidade" => "Cachorros"
    ]];

    public function __construct() {
        
        $auxiliam = session('veterinarios');

        if(!isset($auxiliam)) {
        
            session(['veterinarios' => $this->veterinarios]);
        }
    }
    
    public function index() {
        
        $auxiliam = session('veterinarios');
        
        $clinica = "VetClin DWII";

        return view('veterinarios.index', compact(['auxiliam', 'clinica']));
    }

    public function create() {
        
        return view('veterinarios.create');
    }

   public function store(Request $request) {
        
        $auxiliam = session('veterinarios');

        $crmvs = array_column($auxiliam, 'crmv');

        if(count($crmvs) > 0) {

            $new_crmv = max($crmvs) + 1;
        }

        else {

            $new_crmv = 1;   
        }

        $new_veterinario = [
            "crmv" => $new_crmv,
            "nome" => $request->nome,
            "especialidade" => $request->especialidade
        ];

        array_push($auxiliam, $new_veterinario);
        session(['veterinarios' => $auxiliam]);

        return redirect()->route('veterinarios.index');
    }

    public function show($crmv) {
        
        $auxiliam = session('veterinarios');
        
        $index = array_search($crmv, array_column($auxiliam, 'crmv'));

        $transmitter = $auxiliam[$index];

        return view('veterinarios.show', compact('transmitter'));
    }

    public function edit($crmv) {

        $auxiliam = session('veterinarios');
            
        $index = array_search($crmv, array_column($auxiliam, 'crmv'));

        $transmitter = $auxiliam[$index];    

        return view('veterinarios.edit', compact('transmitter'));        
    }

    public function update(Request $request, $crmv) {
        
        $auxiliam = session('veterinarios');
        
        $index = array_search($crmv, array_column($auxiliam, 'crmv'));

        $new_veterinario = [
            "crmv" => $crmv,
            "nome" => $request->nome,
            "especialidade" => $request->especialidade,
        ];

        $auxiliam[$index] = $new_veterinario;
 
        session(['veterinarios' => $auxiliam]);

        return redirect()->route('veterinarios.index');
    }

    public function destroy($crmv) {
 
        $auxiliam = session('veterinarios');
        
        $index = array_search($crmv, array_column($auxiliam, 'crmv')); 

        unset($auxiliam[$index]);

        session(['veterinarios' => $auxiliam]);

        return redirect()->route('veterinarios.index');
    }
}