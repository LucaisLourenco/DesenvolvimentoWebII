<?php

    include_once ("pessoa.php");

    class conexao {

        private $DB_NOME = "tads20_lucas_lourenco";
        private $DB_USUARIO = "tads20_lucas_lourenco";
        private $DB_SENHA = "tads20_lucas_lourenco";
        private $DB_CHARSET = "utf8";
 
        public function connection() {
            $str_conn = "mysql:host=wagnerweinert.com.br;dbname=".$this->DB_NOME;
            return new PDO($str_conn, $this->DB_USUARIO, $this->DB_SENHA,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".$this->DB_CHARSET));
        }

        function select() {
            $conn = $this->connection();
            $stmt = $conn->prepare("SELECT * FROM pessoa");
            $stmt->execute();
            return $stmt;            
        }

        function select_where($id) {
            $conn = $this->connection();
            $stmt = $conn->prepare("SELECT * FROM pessoa WHERE id=".$id.";");
            $stmt->execute();
            return $stmt;
        }

        function insert($pessoa) {

            $sql = "INSERT INTO pessoa(id, cpf, nome, endereco, telefone) VALUES(".$pessoa->id().",".$pessoa->cpf().",".$pessoa->nome().",".$pessoa->endereco().",".$pessoa->telefone().")";
            
            $conn = $this->connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt;

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
    
    }

?>