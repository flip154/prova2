<?php 

    abstract class Funcionario {
        protected $nome;
        protected $email;
        protected $salario;

        public function __construct($nome, $email, $salario) {
            $this->nome = $nome;
            $this->email = $email;
            $this->salario = $salario;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }
    }
?>