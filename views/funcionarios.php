<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionários</title>
</head>
<body>
    <h1>Funcionários</h1>

    <?php if (!empty($dados['mensagem'])): ?>
        <p><?= htmlspecialchars($dados['mensagem']) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="tipoFuncionario">Tipo:</label>
        <select id="tipoFuncionario" name="tipoFuncionario">
            <option value="FuncionarioComum">Funcionário Comum</option>
            <option value="Gerente">Gerente</option>
        </select>

        <label for="salario">Salário:</label>
        <input type="number" id="salario" name="salario" step="0.01" min="0" required>

        <button type="submit">Cadastrar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Tipo</th>
                <th>Salário</th>
                <th>Bônus</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dados['funcionarios'] as $funcionario): ?>
                <tr>
                    <td><?= htmlspecialchars($funcionario['id']) ?></td>
                    <td><?= htmlspecialchars($funcionario['nome']) ?></td>
                    <td><?= htmlspecialchars($funcionario['email']) ?></td>
                    <td><?= htmlspecialchars($funcionario['tipoFuncionario']) ?></td>
                    <td>R$ <?= number_format((float) $funcionario['salario'], 2, ',', '.') ?></td>
                    <td>R$ <?= number_format((float) $funcionario['bonus'], 2, ',', '.') ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="excluir" value="<?= htmlspecialchars($funcionario['id']) ?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
