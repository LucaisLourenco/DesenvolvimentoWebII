@extends('templates.main', ['titulo' => "Eixos", 'rota' => "eixos.create"])

@section('titulo') Eixos @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist-eixo
                :header="['ID', 'NOME', 'AÇÕES']" 
                :data="$eixos"
                :hide="[true, true, true, true]" 
            />
        </div>
    </div>
@endsection