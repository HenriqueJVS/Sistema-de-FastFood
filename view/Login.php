<?php require __DIR__ . '/layout/header.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Cliente</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <p>
        <a href="index.php?pagina=cadastro">Criar conta</a> |
        <a href="index.php?pagina=recuperar_senha">Esqueci a senha</a>
    </p>
</body>
</html>

<?php require __DIR__ . '/layout/footer.php'; ?>
