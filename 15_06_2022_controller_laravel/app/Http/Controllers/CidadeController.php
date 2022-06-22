<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CidadeController extends Controller {

    public $array_cidades = [[
        'id' => 1,
        'nome' => 'Paranaguá',
        'porte' => 'Médio'
    ]];

    public function __construct() {
        
        $load_cidades = session('cidades');

        if(!isset($load_cidades)) {
            
            session(['cidades' => $this->array_cidades]);
        }
    }

    public function index() {
        
        $load_cidades = session('cidades');

        return view('cidades.index', compact('load_cidades'));
    }

    public function create() {
        
        return view('cidades.create');
    }

    public function store(Request $request) {
        
        $load_cidades = session('cidades');

        $load_id_cidades =array_column($load_cidades,'id');

        if(count($load_id_cidades) > 0) {
            $new_id_cidade = max($load_id_cidades) + 1;
        }

        else {
            $new_id_cidade = 1;
        }

        $new_cidade = [
            'id' => $new_id_cidade,
            'nome' => $request->nome,
            'porte' => $request->porte
        ];

        array_push($load_cidades, $new_cidade);
        
        session(['cidades' => $load_cidades]);

        return redirect()->route('cidades.index');
    }

    public function show($id) {
        
        $load_cidades = session('cidades');

        $busca_posicao = array_search($id, array_column($load_cidades, 'id'));

        $cidade_buscada = $load_cidades[$busca_posicao];

        return view('cidades.show', compact('cidade_buscada'));
    }

    public function edit($id) {
        
        $load_cidades = session('cidades');

        $busca_posicao = array_search($id, array_column($load_cidades, 'id'));

        $cidade_buscada = $load_cidades[$busca_posicao];

        return view('cidades.edit', compact('cidade_buscada'));
    }

    public function update(Request $request, $id) {
        
        $new_cidade = [
            'id' => $id,
            'nome' => $request->nome,
            'porte' => $request->porte
        ];

        $load_cidades = session('cidades');

        $busca_posicao = array_search($id, array_column($load_cidades, 'id'));

        $load_cidades[$busca_posicao] = $new_cidade;

        session(['cidades' => $load_cidades]);
    
        return redirect()->route('cidades.index');
    }

    public function destroy($id) {
        
        $load_cidades = session('cidades');

        $busca_posicao = array_search($id, array_column($load_cidades, 'id'));

        unset($load_cidades[$busca_posicao]);
        
        session(['cidades' => $load_cidades]);

        return redirect()->route('cidades.index');
    }
}
