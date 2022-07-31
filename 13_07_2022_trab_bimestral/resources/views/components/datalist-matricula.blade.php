<div>    
    <table class="table align-middle caption-top table-striped">
        <caption><b>MATRICULAS {{$data['nome']}}</b></caption>
        <thead>
        <tr>
            @php $cont=0; @endphp
            @foreach ($header as $item)

                @if($hide[$cont])
                    <th scope="col" class="d-none d-md-table-cell">{{ $item }}</th>
                @else
                    <th scope="col">{{ $item }}</th>
                @endif
                @php $cont++; @endphp

            @endforeach
        </tr>
        </thead>
        <tbody>
            @foreach ($data->disciplina as $item)
                <tr>
                    <td class="d-none d-md-table-cell">{{ $item['id'] }}</td>
                    <td>{{$item['nome']}}</td>
                </tr>  
            @endforeach      
        </tbody>
    </table>
    <div class="row">
            <div class="col">
                <a href="{{route('matriculas.gravar', $data['id'])}}" class="btn btn-warning btn-block align-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                    &nbsp; Nova Matrícula
                </a>
            </div>
        </div>
    </div>
</div>