<?php require __DIR__ . '/layout/header.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha - FastFood</title>
</head>
<body>
    <h2>Recuperar Senha</h2>
    <form method="POST" action="">
        <label>CPF:</label><br>
        <input type="text" name="cpf" required><br><br>

        <label>Data de Nascimento:</label><br>
        <input type="date" name="data_nascimento" required><br><br>

        <button type="submit">Recuperar</button>
    </form>

    <p><a href="index.php?pagina=login">Voltar para login</a></p>
</body>
</html>
<?php require __DIR__ . '/layout/footer.php'; ?>
