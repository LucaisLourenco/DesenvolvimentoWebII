<?php

    class pessoa {
    
        private $id;
        private $cpf;
        private $nome;
        private $endereco;
        private $telefone;

        function __construct($id,$cpf,$nome,$endereco,$telefone) {
            $this->id = $id;
            $this->cpf = $cpf;
            $this->nome = $nome;
            $this->endereco = $endereco;
            $this->telefone = $telefone;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setCpf($cpf) {
            $this->cpf = $cpf;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setEndereco($endereco) {
            $this->endereco = $endereco;
        }

        public function setTelefone($telefone) {
            $this->telefone = $telefone;
        }
    
        public function getId() {
            return $this->id;
        }

        public function getCpf() {
            return $this->cpf;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getEndereco() {
            return $this->Endereco;
        }

        public function getTelefone() {
            return $this->Telefone;
        }
    }

?>