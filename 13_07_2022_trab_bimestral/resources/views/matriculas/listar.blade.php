@extends('templates.main', ['titulo' => "Disciplinas"])

@section('titulo') Disciplinas @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist-matricula
                :header="['ID', 'DISCIPLINAS']" 
                :data="$aluno"
                :hide="[true, true, true]" 
            />
        </div>
    </div>
@endsection