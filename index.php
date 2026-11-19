<?php

session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Funcionario.php';
require_once __DIR__ . '/models/FuncionarioModel.php';
require_once __DIR__ . '/controllers/FuncionarioController.php';

$mensagem = '';
$modelo = new FuncionarioModel();
$controle = new FuncionarioController($modelo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmarExclusao'])) {
        $controle->excluir($_POST['id'] ?? 0);
    } else {
        $mensagem = $controle->cadastrar($_POST);
        if ($mensagem !== '') {
            $_SESSION['mensagem'] = $mensagem;
        }
    }
}

if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
}

$funcionarios = $modelo->listar();

require_once __DIR__ . '/views/funcionarios.php';