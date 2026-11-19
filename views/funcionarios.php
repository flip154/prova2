<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/funcionarios.css">
    <title>Cadastro de Funcionários</title>
</head>
<body>
    <h1>Cadastro de Funcionários</h1>

    <?php if ($mensagem != ''): ?>
        <p><?= $mensagem ?></p>
    <?php endif; ?>

    <?php if (isset($_GET['excluir'])): ?>
        <h2>Confirmar exclusão</h2>
        <p>Deseja excluir este funcionário?</p>

        <form method="POST">
            <input type="hidden" name="confirmarExclusao" value="sim">
            <input type="hidden" name="id" value="<?= $_GET['excluir'] ?>">
            <button type="submit">Confirmar exclusão</button>
        </form>

        <a href="index.php">Cancelar</a>

    <?php else: ?>
        <form method="POST">
            <label>Nome:</label>
            <input type="text" name="nome">
            <br>

            <label>E-mail:</label>
            <input type="email" name="email">
            <br>

            <label>Salário:</label>
            <input type="number" name="salario" step="0.01">
            <br>

            <label>Tipo:</label>
            <select name="tipo">
                <option value="FuncionarioComum">Funcionário Comum</option>
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
                    <td><?= $linha['id'] ?></td>
                    <td><?= $linha['nome'] ?></td>
                    <td><?= $linha['email'] ?></td>
                    <td><?= $linha['salario'] ?></td>
                    <td><?= $linha['tipo'] ?></td>
                    <td><?= $linha['bonus'] ?></td>
                    <td>
                        <a href="index.php?excluir=<?= $linha['id'] ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
