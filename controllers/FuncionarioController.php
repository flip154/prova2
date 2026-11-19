<?php

require_once __DIR__ . '/../models/FuncionarioModel.php';

class FuncionarioController
{
    private FuncionarioModel $model;

    public function __construct()
    {
        $this->model = new FuncionarioModel();
    }

    public function processar(): array
    {
        $mensagem = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['excluir'])) {
                $this->model->excluir((int) $_POST['excluir']);
                $mensagem = 'Funcionário excluído com sucesso.';
            } else {
                $nome = trim($_POST['nome'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $tipoFuncionario = $_POST['tipoFuncionario'] ?? 'FuncionarioComum';
                $salario = str_replace(',', '.', $_POST['salario'] ?? '0');

                if ($nome === '' || $email === '' || !is_numeric($salario)) {
                    $mensagem = 'Preencha nome, e-mail e salário corretamente.';
                } else {
                    if (!in_array($tipoFuncionario, ['FuncionarioComum', 'Gerente'], true)) {
                        $tipoFuncionario = 'FuncionarioComum';
                    }

                    $this->model->cadastrar($nome, $email, $tipoFuncionario, (float) $salario);
                    $mensagem = 'Funcionário cadastrado com sucesso.';
                }
            }
        }

        return [
            'mensagem' => $mensagem,
            'funcionarios' => $this->model->listar(),
        ];
    }
}
