<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;

$GLOBALS['regras'] = [
    'nome' => 'required|max:50|min:10',
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 50 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 10 caracteres!",
];

class EixoController extends Controller {
    
    public function index()
    {
        $eixos = Eixo::all();
        $instituto = "IFPR DWII";

        return view('eixos.index', compact(['eixos', 'instituto']));
    }

    public function create()
    {
        return view('eixos.create');
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        Eixo::create([
            "nome" => mb_strtoupper($request->nome)
        ]);

        return redirect()->route('eixos.index');
    }

    public function show($id)
    {
        $eixo = Eixo::find($id);

        return view('eixos.show', compact(['eixo']));
    }

    public function edit($id)
    {
        $eixo = Eixo::find($id);

        return view('eixos.edit', compact(['eixo']));
    }

    public function update(Request $request, $id)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $new_eixo = Eixo::find($id);

        $new_eixo->update([
            "nome" => $request->nome
        ]);

        return redirect()->route('eixos.index');
    }

    public function destroy($id)
    {
        try
        {
            $eixo = Eixo::find($id);
            $eixo->delete();
            
        } catch(\Illuminate\Database\QueryException $ex)
        { 
            $mensagem = $ex->getMessage(); 
        }

        return redirect()->route('eixos.index');
    }
}
