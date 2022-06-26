@extends('templates.main', ['titulo' => "Veterinários", 'rota' => "veterinarios.create"])

@section('titulo') Veterinários @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist-veterinario
                :header="['CRMV', 'NOME', 'ESPECIALIDADE', 'AÇÕES']" 
                :data="$auxiliam"
                :hide="[true, false, true, false]" 
            />
        </div>
    </div>
@endsection