@extends('templates.main', ['titulo' => "Disciplinas", 'rota' => "disciplinas.create"])

@section('titulo') Disciplinas @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist-disciplina
                :header="['ID', 'NOME', 'CARGA', 'CURSO', 'AÇÕES']" 
                :data="$disciplinas"
                :cursos="$cursos"
                :hide="[true, true, true, true, true]" 
            />
        </div>
    </div>
@endsection