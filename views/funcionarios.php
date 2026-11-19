<?php
$mensagem = $mensagem ?? '';
$funcionarios = $funcionarios ?? [];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionários</title>
    <link rel="stylesheet" href="css/funcionarios.css">
</head>
<body>
    <h1>Cadastro de Funcionários</h1>

    <?php if ($mensagem != ''): ?>
        <p><?= htmlspecialchars($mensagem) ?></p>
    <?php endif; ?>

    <?php if (isset($_GET['excluir'])): ?>
        <h2>Confirmar exclusão</h2>
        <p>Deseja excluir este funcionário?</p>

        <form method="POST">
            <input type="hidden" name="confirmarExclusao" value="sim">
            <input type="hidden" name="id" value="<?= (int) $_GET['excluir'] ?>">
            <button type="submit">Confirmar exclusão</button>
        </form>

        <a href="index.php">Cancelar</a>

    <?php else: ?>
        <form method="POST">
            <label>Nome:</label>
            <input type="text" name="nome" required>
            <br>

            <label>E-mail:</label>
            <input type="email" name="email" required>
            <br>

            <label>Salário:</label>
            <input type="number" name="salario" step="0.01" min="0" required>
            <br>

            <label>Tipo:</label>
            <select name="tipo" required>
                <option value="FuncionarioComum">Funcionário</option>
                <option value="Gerente">Gerente</option>
            </select>
            <br>

            <button type="submit">Cadastrar</button>
        </form>

        <h2>Lista de funcionários</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Salário</th>
                <th>Tipo</th>
                <th>Bônus</th>
                <th>Ação</th>
            </tr>

            <?php foreach ($funcionarios as $linha): ?>
                <tr>
                    <td><?= (int) $linha['id'] ?></td>
                    <td><?= htmlspecialchars($linha['nome']) ?></td>
                    <td><?= htmlspecialchars($linha['email']) ?></td>
                    <td><?= number_format((float) $linha['salario'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($linha['tipo']) ?></td>
                    <td><?= number_format((float) $linha['bonus'], 2, ',', '.') ?></td>
                    <td>
                        <a href="index.php?excluir=<?= (int) $linha['id'] ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
