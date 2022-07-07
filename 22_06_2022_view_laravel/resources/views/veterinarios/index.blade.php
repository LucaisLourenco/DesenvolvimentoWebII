@extends('templates.main', ['titulo' => "Veterinários", 'rota' => "veterinarios.create"])

@section('titulo') Veterinários @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist-veterinario
                :header="['ID', 'CRMV', 'NOME', 'ESPECIALIDADE', 'AÇÕES']" 
                :data="$dados"
                :esp="$esp"
                :hide="[true, false, true, false, true]" 
            />
        </div>
    </div>
@endsection