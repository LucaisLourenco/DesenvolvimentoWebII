<?php

    class conexao {

        private $DB_NOME = "desenvolvimentoweb";
        private $DB_USUARIO = "root@localhost";
        private $DB_SENHA = "";
        private $DB_CHARSET = "utf8";
 
        public function connection() {
            $str_conn = "mysql:host=localhost;dbname=".$this->DB_NOME;
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
            $stmt = $conn->prepare("SELECT * FROM pessoa WHERE id=$id");
            $stmt->execute();
            return $stmt;
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
    
    }

?>