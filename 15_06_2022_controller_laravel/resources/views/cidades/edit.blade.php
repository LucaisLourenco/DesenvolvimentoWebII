<h2>Alterar Cidade</h2>
<form action="{{ route('cidades.update', $cidade_buscada['id']) }}" method="POST">
   
   @csrf
   @method('PUT')
   <a href="{{route('cidades.index')}}"><h4>voltar</h4></a>
   <label>Nome: </label> <input type='text' name='nome' value='{{$cidade_buscada['nome']}}'>
   <label>Porte: </label> <input type='text' name='porte' value='{{$cidade_buscada['porte']}}'>
   <input type="submit" value="Salvar">
</form>