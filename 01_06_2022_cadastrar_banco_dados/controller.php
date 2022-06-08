<?php

    include_once ("conexao.php");
    include_once ("pessoa.php");

    function rotas($url) {
        
        $dados = explode("/",$url);

        if(strcmp($dados[0], "cadastrar") == 0) {
            echo "<script> window.location='viewCadastrar.php' </script>";
        }

        else if(strcmp($dados[0], "alterar") == 0) {

            $carregarPessoa = new conexao();
            $p = $carregarPessoa->select_where($dados[1]);

            $aux = $p->fetchObject();

			if($aux == null) {
				echo "<script> alert('Código da pessoa não encontrado') </script>";
            }
            
			else {	
                
                print_r($aux);
                
                $url = "viewAlterar.php?id=".$aux->id."&cpf=".$aux->cpf."&nome=".$aux->nome."&endereco=".$aux->endereco."&telefone=".$aux->telefone;

				echo "<script> window.location='".$url."' </script>";
			}
		}
        

        else if(strcmp($dados[0], "remover") == 0) {
            echo "<script> window.location='viewRemover.php?cpf=".$dados[1]."' </script>";
        }
    }

    function cadastrar_pessoa() {
        $dados = new pessoa($_POST['id'],$_POST['cpf'],$_POST['nome'],$_POST['endereco'],$_POST['telefone']);

        $conn = new conexao();
        $conn->insert($dados);

        echo "<script> window.location='viewMain.php' </script>";
    }

    function alterar_pessoa() {
        $dados = new pessoa($_POST['id'],$_POST['cpf'],$_POST['nome'],$_POST['endereco'],$_POST['telefone']);
        
        $conn = new conexao();
        $conn->update($dados, $_POST['id']);
        echo "<script> window.location='viewMain.php' </script>";
    }

    function remover_pessoa() {
        $dados = new pessoa($_POST['id'],$_POST['cpf'],$_POST['nome'],$_POST['endereco'],$_POST['telefone']);

        delete($dados, $_POST['id']);
        echo "<script> window.location='viewMain.php' </script>";
    }

    function loadPessoas() {

        $carregarPessoa = new conexao();
        $pessoa = $carregarPessoa->select();

        $pessoas = array();

        while($objpessoa = $pessoa->fetchObject()) {
            array_push($pessoas,$objpessoa);
        }

        foreach($pessoas as $id => $dados) {
            
            if(!empty($dados)) {
                echo "<tr>";

                    echo "<td>".$dados->id."</td>";
                    echo "<td>".$dados->cpf."</td>";
                    echo "<td>".$dados->nome."</td>";
                    echo "<td>".$dados->endereco."</td>";
                    echo "<td>".$dados->telefone."</td>";
                    

                    echo "<td>";
                        echo "<button type='submit' name='acao' value='alterar/".$dados->id."' class='btn btn-success'>";
                            echo "<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='#FFF' class='bi bi-arrow-counterclockwise' viewBox='0 0 16 16'>";
                                echo "<path fill-rule='evenodd' d='M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z'/>";
                                echo "<path d='M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z'/>";
                            echo "</svg>";
                        echo "</button>";
                        echo "&nbsp";
                        echo "<button type='submit' name='acao' value='remover/".$dados->id."' class='btn btn-danger'>";
                            echo "<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='#FFF' class='bi bi-trash-fill' viewBox='0 0 16 16'>";
                                echo "<path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>";
                            echo "</svg>";
                        echo "</button>";
                    echo "</td>";
                echo "</tr>"; 
            }
        }
    }

?>  