<?php

require_once __DIR__ . '/../models/FuncionarioModel.php';

class FuncionarioController
{
    private FuncionarioModel $modelo;

    public function __construct()
    {
        $this->modelo = new FuncionarioModel();
    }

    public function processar(): array
    {
        $mensagem = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['confirmarExclusao']) && isset($_POST['excluir'])) {
                $mensagem = $this->excluir((int) $_POST['excluir']);

            } elseif (($_POST['acao'] ?? '') === 'cadastrar') {
                $mensagem = $this->cadastrar($_POST);
            }
        }

        return [
            'mensagem' => $mensagem,
            'funcionarios' => $this->modelo->listar(),
        ];
    }

    public function cadastrar($dados)
    {
        $nome = trim($dados['nome'] ?? '');
        $email = trim($dados['email'] ?? '');
        $salario = trim($dados['salario'] ?? '');
        $tipo = $dados['tipoFuncionario'] ?? '';

        if ($nome === '' || $email === '' || $salario === '' || $tipo === '') {
            return 'Preencha todos os campos obrigatórios.';
        }

        if (!is_numeric($salario)) {
            return 'O salário deve ser um número.';
        }

        $this->modelo->cadastrar($nome, $email, (float) $salario, $tipo);

        return 'Funcionário cadastrado com sucesso.';
    }

    public function excluir($id)
    {
        if ($id > 0) {
            $this->modelo->excluir($id);
            return 'Funcionário excluído com sucesso.';
        }

        return 'Não foi possível excluir o funcionário.';
    }
}
