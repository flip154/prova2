<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/Funcionario.php';

class FuncionarioModel
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = conectarBanco();
    }

    public function cadastrar($nome, $email, $salario, $tipo)
    {
        $sql = 'INSERT INTO funcionarios (nome, email, salario, tipo)
                VALUES (?, ?, ?, ?)';
        $comando = $this->conexao->prepare($sql);
        $comando->execute([$nome, $email, $salario, $tipo]);
    }

    public function listar()
    {
        $sql = 'SELECT * FROM funcionarios';
        $linhas = $this->conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        foreach ($linhas as &$linha) {
            if ($linha['tipo'] === 'Gerente') {
                $funcionario = new Gerente($linha['nome'], $linha['email'], $linha['salario']);
            } else {
                $funcionario = new FuncionarioComum($linha['nome'], $linha['email'], $linha['salario']);
            }

            $linha['bonus'] = $funcionario->calcularBonus();
        }

        return $linhas;
    }

    public function excluir($id)
    {
        $sql = 'DELETE FROM funcionarios WHERE id = ?';
        $comando = $this->conexao->prepare($sql);
        $comando->execute([$id]);
    }
}
