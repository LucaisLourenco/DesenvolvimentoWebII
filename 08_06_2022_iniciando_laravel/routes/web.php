<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    //ROTA DE ALUNOS
    
Route::prefix('/alunos')->group(function() {
    
    Route::get('/', function() {
        
        $alunos = "<ul>
            <li>1 - Ana</li>
            <li>2 - Bruno</li>
            <li>3 - Carol</li>
            <li>4 - Danilo</li>
            <li>5 - Ellen</li>
        </ul>";

        return $alunos;

    })->name('alunos');

    Route::get('/limite/{quantidade}', function($quantidade) {
        
        $lstAlunos = array(
            "1 - Ana",
            "2 - Bruno",
            "3 - Carol",
            "4 - Danilo",
            "5 - Ellen"
        );

        $alunos = "<ul>";
        
        if($quantidade <= count($lstAlunos)) {
            
            $contador = 0;

            foreach($lstAlunos as $nome) {
                $alunos .= "<li>$nome";
                $contador++;
                if($contador >= $quantidade) {
                    break;
                }
            }
        } else {
            $alunos = $alunos."<li>Quantidade máximo = ".count($lstAlunos)."</li>";
        }

        $alunos .= "</ul>";

        return $alunos;
    })->where('quantidade','[0-9]+')->name('alunos.limite');

    Route::get('/matricula/{posicao}', function($posicao) {

        $lstAlunos = array(
            "1 - Ana",
            "2 - Bruno",
            "3 - Carol",
            "4 - Danilo",
            "5 - Ellen"
        );

        $alunos = "<ul>";
        
        if($posicao < count($lstAlunos)) {
            
            $alunos .= "<li>".$lstAlunos[$posicao - 1];

        } else {
            $alunos = $alunos."<li>ALUNO NÃO ENCONTRADO!!!</li>";
        }

        $alunos .= "</ul>";

        return $alunos;
    })->where('posicao','[0-9]+')->name('alunos.matricula');

    Route::get('/nome/{nomeAux}', function($nomeAux) {

        $lstAlunos = array(
            "1" => "Ana",
            "2" => "Bruno",
            "3" => "Carol",
            "4" => "Danilo",
            "5" => "Ellen"
        );

        $alunos = "<ul>";

        $aux = null; 

        foreach($lstAlunos as $id => $nome) {
            if ($nome == $nomeAux) {
                $aux .= "<li>".$id." - ".$nome;
            } 
        }
        
        if ($aux != null) {
            $alunos .= $aux;
        } else {
            $alunos = $alunos."<li>ALUNO NÃO ENCONTRADO!!!</li>";
        }

        $alunos .= "</ul>";

        return $alunos;
    })->where('nomeAux','[A-Za-z]+')->name('alunos.nome');
});

//ROTA DE NOTAS

Route::prefix('/nota')->group(function() {

    Route::get('/', function() {

        $lstAlunos = session('alunos');

        if(!isset($lstAlunos)) {

            $lstAlunos = array( 
                array( 
                    "matricula" => "1",
                    "nome" => "Ana",
                    "nota" => "9"
                ),

                array(
                    "matricula" => "2",
                    "nome" => "Bruno",
                    "nota" => "2"
                ),

                array(
                    "matricula" => "3",
                    "nome" => "Carol",
                    "nota" => "8"
                ),

                array(
                    "matricula" => "4",
                    "nome" => "Danilo",
                    "nota" => "6"
                ),

                array(
                    "matricula" => "5",
                    "nome" => "Ellen",
                    "nota" => "4"
                )
            );

           session(['alunos' => $this->lstAlunos]);
        } 

        $alunos = null;
        $alunos .= "<div class='row'>";
        $alunos .= "<div class='col'>";
        $alunos .= "<table class='table align-middle caption-top table-striped'>";
        $alunos .= "<thead>";
        $alunos .= "<tr>";
        $alunos .= "<th scope='col' class='d-none d-md-table-cell'>MATRÍCULA</th>";
        $alunos .= "<th scope='col'>NOME</th>";
        $alunos .= "<th scope='col' class='d-none d-md-table-cell'>NOTA</th>";
        $alunos .= "</tr>";
        $alunos .= "</thead>";
        $alunos .= "<tbody align='center'>";

        for($count = 0; $count < count($lstAlunos); $count++) {
                $alunos .= "<tr>";
                $alunos .= "<td>".$lstAlunos[$count]['matricula']."</td>";
                $alunos .= "<td>".$lstAlunos[$count]['nome']."</td>";
                $alunos .= "<td>".$lstAlunos[$count]['nota']."</td>";
                $alunos .= "</tr>";
        } 

        $alunos .= "</tbody>";
        $alunos .= "</table>";
        $alunos .= "</div>";
        $alunos .= "</div>";

        return $alunos;
    })->name('nota');

    Route::get('/limite/{quantidade}', function($quantidade) {

        $lstAlunos = session('alunos');

        if(!isset($lstAlunos)) {

            $lstAlunos = array( 
                array( 
                    "matricula" => "1",
                    "nome" => "Ana",
                    "nota" => "9"
                ),

                array(
                    "matricula" => "2",
                    "nome" => "Bruno",
                    "nota" => "2"
                ),

                array(
                    "matricula" => "3",
                    "nome" => "Carol",
                    "nota" => "8"
                ),

                array(
                    "matricula" => "4",
                    "nome" => "Danilo",
                    "nota" => "6"
                ),

                array(
                    "matricula" => "5",
                    "nome" => "Ellen",
                    "nota" => "4"
                )
            );

           session(['alunos' => $this->lstAlunos]);
        } 

        $alunos = null;

        if($quantidade <= count($lstAlunos)) {

            $alunos .= "<div class='row'>";
            $alunos .= "<div class='col'>";
            $alunos .= "<table class='table align-middle caption-top table-striped'>";
            $alunos .= "<thead>";
            $alunos .= "<tr>";
            $alunos .= "<th scope='col' class='d-none d-md-table-cell'>MATRÍCULA</th>";
            $alunos .= "<th scope='col'>NOME</th>";
            $alunos .= "<th scope='col' class='d-none d-md-table-cell'>NOTA</th>";
            $alunos .= "</tr>";
            $alunos .= "</thead>";
            $alunos .= "<tbody align='center'>";

            for($count = 0; $count < count($lstAlunos); $count++) {
                $alunos .= "<tr>";
                $alunos .= "<td>".$lstAlunos[$count]['matricula']."</td>";
                $alunos .= "<td>".$lstAlunos[$count]['nome']."</td>";
                $alunos .= "<td>".$lstAlunos[$count]['nota']."</td>";
                $alunos .= "</tr>";

                if($count == $quantidade - 1) { break; }
            } 

            $alunos .= "</tbody>";
            $alunos .= "</table>";
            $alunos .= "</div>";
            $alunos .= "</div>";
        } 

        else {$alunos = $alunos."<li>QUANTIDADE INVÁLIDA!!!</li>";}

        return $alunos;
    })->where('quantidade','[0-9]+')->name('nota.limite');

    Route::get('/lancar/{valor}/{id}/{nome?}', function($valor, $id, $nome = null) {

        $lstAlunos = session('alunos');

        if(!isset($lstAlunos)) {

            $lstAlunos = array( 
                array( 
                    "matricula" => "1",
                    "nome" => "Ana",
                    "nota" => "9"
                ),

                array(
                    "matricula" => "2",
                    "nome" => "Bruno",
                    "nota" => "2"
                ),

                array(
                    "matricula" => "3",
                    "nome" => "Carol",
                    "nota" => "8"
                ),

                array(
                    "matricula" => "4",
                    "nome" => "Danilo",
                    "nota" => "6"
                ),

                array(
                    "matricula" => "5",
                    "nome" => "Ellen",
                    "nota" => "4"
                )
            );

           session(['alunos' => $this->lstAlunos]);
        }    

        for($count = 0; $count < count($lstAlunos); $count++) {

            if ($nome == null) {
            
                if($lstAlunos[$count]['matricula'] == $id) {

                    $new = [  
                        'matricula' => $lstAlunos[$count]['matricula'],
                        'nome' => $lstAlunos[$count]['nome'],
                        'nota' => $valor
                    ];

                    $lstAlunos[$count] = $new;
                    session(['alunos' => $lstAlunos]);
                } 

            } else {
                
                if($lstAlunos[$count]['nome'] == $nome) {

                    $new = [  
                        'matricula' => $lstAlunos[$count]['matricula'],
                        'nome' => $lstAlunos[$count]['nome'],
                        'nota' => $valor
                    ];

                    $lstAlunos[$count] = $new;
                    session(['alunos' => $lstAlunos]);
                } 
            }
        }

        $alunos = null;
        $alunos .= "<div class='row'>";
        $alunos .= "<div class='col'>";
        $alunos .= "<table class='table align-middle caption-top table-striped'>";
        $alunos .= "<thead>";
        $alunos .= "<tr>";
        $alunos .= "<th scope='col' class='d-none d-md-table-cell'>MATRÍCULA</th>";
        $alunos .= "<th scope='col'>NOME</th>";
        $alunos .= "<th scope='col' class='d-none d-md-table-cell'>NOTA</th>";
        $alunos .= "</tr>";
        $alunos .= "</thead>";
        $alunos .= "<tbody align='center'>";

        for($count = 0; $count < count($lstAlunos); $count++) {
            $alunos .= "<tr>";
            $alunos .= "<td>".$lstAlunos[$count]['matricula']."</td>";
            $alunos .= "<td>".$lstAlunos[$count]['nome']."</td>";
            $alunos .= "<td>".$lstAlunos[$count]['nota']."</td>";
            $alunos .= "</tr>";
        } 

        $alunos .= "</tbody>";
        $alunos .= "</table>";
        $alunos .= "</div>";
        $alunos .= "</div>";

        return $alunos;
    
    })->where('valor','[0-9]+')->where('id','[0-9]+')->name('nota.lancar');

    Route::get('/conceito/{A}/{B}/{C}', function($a,$b,$c) {

        $lstAlunos = session('alunos');

        if(!isset($lstAlunos)) {

            $lstAlunos = array( 
                array( 
                    "matricula" => "1",
                    "nome" => "Ana",
                    "nota" => "9"
                ),

                array(
                    "matricula" => "2",
                    "nome" => "Bruno",
                    "nota" => "2"
                ),

                array(
                    "matricula" => "3",
                    "nome" => "Carol",
                    "nota" => "8"
                ),

                array(
                    "matricula" => "4",
                    "nome" => "Danilo",
                    "nota" => "6"
                ),

                array(
                    "matricula" => "5",
                    "nome" => "Ellen",
                    "nota" => "4"
                )
            );

           session(['alunos' => $this->lstAlunos]);
        }    

        for($count = 0; $count < count($lstAlunos); $count++) {
            
            if($lstAlunos[$count]['nota'] >= $a)  {
                $new = [  
                    'matricula' => $lstAlunos[$count]['matricula'],
                    'nome' => $lstAlunos[$count]['nome'],
                    'nota' => "A"
                ];
    
                    $lstAlunos[$count] = $new;
            }

            elseif($lstAlunos[$count]['nota'] >= $b && $lstAlunos[$count]['nota'] < $a)  {
                $new = [  
                    'matricula' => $lstAlunos[$count]['matricula'],
                    'nome' => $lstAlunos[$count]['nome'],
                    'nota' => "B"
                ];
    
                    $lstAlunos[$count] = $new;
            }
            
            else {
                $new = [  
                    'matricula' => $lstAlunos[$count]['matricula'],
                    'nome' => $lstAlunos[$count]['nome'],
                    'nota' => "C"
                ];
    
                    $lstAlunos[$count] = $new;
            }
        }

        $alunos = null;
        $alunos .= "<div class='row'>";
        $alunos .= "<div class='col'>";
        $alunos .= "<table class='table align-middle caption-top table-striped'>";
        $alunos .= "<thead>";
        $alunos .= "<tr>";
        $alunos .= "<th scope='col' class='d-none d-md-table-cell'>MATRÍCULA</th>";
        $alunos .= "<th scope='col'>NOME</th>";
        $alunos .= "<th scope='col' class='d-none d-md-table-cell'>NOTA</th>";
        $alunos .= "</tr>";
        $alunos .= "</thead>";
        $alunos .= "<tbody align='center'>";

        for($count = 0; $count < count($lstAlunos); $count++) {
            $alunos .= "<tr>";
            $alunos .= "<td>".$lstAlunos[$count]['matricula']."</td>";
            $alunos .= "<td>".$lstAlunos[$count]['nome']."</td>";
            $alunos .= "<td>".$lstAlunos[$count]['nota']."</td>";
            $alunos .= "</tr>";
        } 

        $alunos .= "</tbody>";
        $alunos .= "</table>";
        $alunos .= "</div>";
        $alunos .= "</div>";

        return $alunos;
    
    })->where('valor','[0-9]+')->where('id','[0-9]+')->name('nota.conceito');

});