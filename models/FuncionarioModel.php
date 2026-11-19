<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/Funcionario.php';

class FuncionarioModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::conectar();
    }

    public function cadastrar($nome, $email, $tipoFuncionario, $salario): bool
    {
        $sql = 'INSERT INTO funcionarios (nome, email, tipoFuncionario, salario)
                VALUES (:nome, :email, :tipoFuncionario, :salario)';
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':tipoFuncionario' => $tipoFuncionario,
            ':salario' => $salario,
        ]);
    }

    public function listar(): array
    {
        $sql = 'SELECT id, nome, email, tipoFuncionario, salario
                FROM funcionarios
                ORDER BY id DESC';

        $rows = $this->pdo->query($sql)->fetchAll();

        foreach ($rows as &$row) {
            $funcionario = $this->criarObjeto($row);
            $row['bonus'] = $funcionario->calcularBonus();
        }

        return $rows;
    }

    public function excluir($id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM funcionarios WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    private function criarObjeto(array $dados): Funcionario
    {
        if ($dados['tipoFuncionario'] === 'Gerente') {
            return new Gerente($dados['nome'], $dados['email'], (float) $dados['salario']);
        }

        return new FuncionarioComum($dados['nome'], $dados['email'], (float) $dados['salario']);
    }
}
