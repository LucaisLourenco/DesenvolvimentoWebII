@extends('templates.main', ['titulo' => "Alunos", 'rota' => "alunos.create"])

@section('titulo') Alunos @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist-aluno
                :header="['ID', 'NOME', 'CURSO', 'AÇÕES']" 
                :data="$alunos"
                :hide="[true, true, true, true]" 
            />
        </div>
    </div>
@endsection