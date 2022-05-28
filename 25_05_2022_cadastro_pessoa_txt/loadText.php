<?php

	function select() {

		$pessoas = array();
		$fp = fopen('pessoas.txt', 'r');

        if($fp) {
            while(!feof($fp)) {
				$arr = array();
                $id = fgets($fp);
				$dados = fgets($fp);
				if(!empty($dados)) {
					$arr = explode("#", $dados);
					$pessoas[$id] = $arr;
				}
			}
			fclose($fp);
		}

		return $pessoas;
	}

	function select_where($id) {

		$pessoas = select();

		foreach ($pessoas as $chave => $dados) {
			if(strcmp($id, trim($chave)) == 0) { 
				return $dados;
			}
		}

		return null;	
	}

	function insert($pessoa) {

		$fp = fopen('pessoas.txt', 'a+');

		if ($fp) {
			foreach($pessoa as $id => $dados) {
				if(!empty($dados)) {
					fputs($fp, $id);
					fputs($fp, "\n");
					$linha = $dados['cpf']."#".$dados['nome']."#".$dados['endereco']."#".$dados['telefone'];
					fputs($fp, $linha);
					fputs($fp, "\n");
				}
			}
            
			fclose($fp);
			echo "<script> alert('Pessoa cadastrada com sucesso!') </script>";
		}
	}

	function update($new, $id) {

		$pessoas = select();

		$fp = fopen('bkp.txt', 'a+');

		if ($fp) {
			foreach($pessoas as $chave => $dados) {
				if(!empty($dados)) {
					fputs($fp, $chave);
					if($id == trim($chave)){
						foreach($new as $new_id => $new_dados) {
							if(!empty($new_dados)) {
								$linha=$new_dados['cpf']."#".$new_dados['nome']."#".$new_dados['endereco']."#".$new_dados['telefone']."\n";
							}
						}
					}
					else 
						$linha=$dados[0]."#".$dados[1]."#".$dados[2]."#".$dados[3];
					fputs($fp, $linha);
				}
			}

            fclose($fp);
			echo "<script> alert('Pessoa alterada sucesso!') </script>";

			unlink("pessoas.txt");
			rename("bkp.txt", "pessoas.txt");
		}
	}

	function delete() {

	}

?>