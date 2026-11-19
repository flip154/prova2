<?php 

    abstract class Funcionario {
        private $nome;
        private $email;
        private $salario;

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

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getSalario() {
            return $this->salario;
        }

        public function setSalario($salario) {
            $this->salario = $salario;
        }

        abstract public function calcularBonus();
    }

    class FuncionarioComum extends Funcionario {
        public function calcularBonus() {
            return $this->getSalario() * 0.05;
        }
    }

    class Gerente extends Funcionario {
        public function calcularBonus() {
            return $this->getSalario() * 0.15;
        }
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
            $nome = $_POST["nome"] ?? "";
            $email = $_POST["email"] ?? "";
            $salario = $_POST["salario"] ?? 0;
    }
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prova Poo</title>
</head>
<body>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome">
        <p></p>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <p></p>
        <label for="salario">Salário:</label>
        <input type="text" id="salario" name="salario">
        <p></p>
        <button type="submit">Cadastrar</button>
</body>
</html>