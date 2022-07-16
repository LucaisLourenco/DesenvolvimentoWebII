@extends('templates.main', ['titulo' => "Professores", 'rota' => "professores.create"])

@section('titulo') Professores @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist-professor
                :header="['ID', 'NOME', 'EIXO', 'ATIVO', 'AÇÕES']" 
                :data="$professores"
                :eixos="$eixos"
                :hide="[true, true, true, true, true]" 
            />
        </div>
    </div>
@endsection