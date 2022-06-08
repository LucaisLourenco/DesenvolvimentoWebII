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
            $stmt = $conn->prepare("SELECT * FROM pessoa WHERE id=".$id);
            $stmt->execute();
            return $stmt;
        }

        function insert(pessoa $pessoa) {
            $sql = "INSERT INTO pessoa(id, cpf, nome, endereco, telefone) VALUES(".$pessoa->getId().","."'".$pessoa->getCpf()."'".","."'".$pessoa->getNome()."'".","."'".$pessoa->getEndereco()."'".","."'".$pessoa->getTelefone()."'".")";
            
            $conn = $this->connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        function update(pessoa $pessoa, $id) {

            $sql = "UPDATE pessoa SET id =".$pessoa->getId().",cpf="."'".$pessoa->getCpf()."'".",nome="."'".$pessoa->getNome()."'".",endereco="."'".$pessoa->getEndereco()."'".",telefone="."'".$pessoa->getTelefone()."' WHERE id = ".$pessoa->getId()."";

            $conn = $this->connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        function delete() {

        }
    
    }

?>