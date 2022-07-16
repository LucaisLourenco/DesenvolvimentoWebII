@extends('templates.main', ['titulo' => "Cursos", 'rota' => "cursos.create"])

@section('titulo') Cursos @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist-curso
                :header="['ID', 'NOME', 'SIGLA', 'EIXO', 'AÇÕES']" 
                :data="$cursos"
                :eixos="$eixos"
                :hide="[true, true, true, true, true]" 
            />
        </div>
    </div>
@endsection