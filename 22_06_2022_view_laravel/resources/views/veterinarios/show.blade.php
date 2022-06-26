<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do Veterinário</title>
</head>
<body>
    <a href="{{route('veterinarios.index')}}">Voltar</a>
    <br>
    <label>CRMV: </label>{{$auxiliam['crmv']}}
    <br>
    <label>Nome: </label>{{$auxiliam['nome']}}
    <br>
    <label>Especialidade: </label>{{$auxiliam['especialidade']}}
</body>
</html>