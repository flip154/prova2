<?php

session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Funcionario.php';
require_once __DIR__ . '/models/FuncionarioModel.php';
require_once __DIR__ . '/controllers/FuncionarioController.php';

$modelo = new FuncionarioModel();
$controle = new FuncionarioController($modelo);

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmarExclusao'])) {
        $id = $_POST['id'] ?? 0;
        $mensagem = $controle->excluir($id);
    } else {
        $mensagem = $controle->cadastrar($_POST);
    }

    $_SESSION['mensagem'] = $mensagem;
    header('Location: index.php');
    exit;
}

if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
}

$funcionarios = $modelo->listar();

require_once __DIR__ . '/views/funcionarios.php';