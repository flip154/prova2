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
                $this->modelo->excluir((int) $_POST['excluir']);
                $mensagem = 'Funcionário excluído com sucesso.';

            } elseif (($_POST['acao'] ?? '') === 'cadastrar') {
                $nome = trim($_POST['nome'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $salario = trim($_POST['salario'] ?? '');
                $tipoFuncionario = $_POST['tipoFuncionario'] ?? '';

                if ($nome === '' || $email === '' || $salario === '' || $tipoFuncionario === '') {
                    $mensagem = 'Preencha todos os campos obrigatórios.';

                } elseif (!is_numeric($salario)) {
                    $mensagem = 'O salário deve ser um número.';
                    
                } else {
                    $this->modelo->cadastrar($nome, $email, (float) $salario, $tipoFuncionario);
                    $mensagem = 'Funcionário cadastrado com sucesso.';
                }
            }
        }

        return [
            'mensagem' => $mensagem,
            'funcionarios' => $this->modelo->listar(),
        ];
    }
}
