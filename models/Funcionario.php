<?php

abstract class Funcionario
{
    protected $nome;
    protected $email;
    protected $salario;

    public function __construct($nome, $email, $salario)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->salario = $salario;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function setSalario($salario)
    {
        $this->salario = $salario;
    }

    abstract public function calcularBonus();
}

class FuncionarioComum extends Funcionario
{
    public function calcularBonus()
    {
        return $this->salario * 0.05;
    }
}

class Gerente extends Funcionario
{
    public function calcularBonus()
    {
        return $this->salario * 0.15;
    }
}
