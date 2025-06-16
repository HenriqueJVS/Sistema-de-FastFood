<?php require __DIR__ . '/layout/header.php' ?>
<?php
$id = $produto->id ?? '';
$nome = $produto->nome ?? '';
$preco = $produto->preco ?? '';
$categoria = $produto->categoria ?? '';
$descricao = $produto->descricao ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <style>
        form {
            max-width: 400px;
            margin: 50px auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            font-family: Arial, sans-serif;
        }
        label {
            display: block;
            margin-top: 10px;
            text-align: left;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #555;
        }
    </style>
</head>
<body>

    <form method="post" action="index.php?pagina=gerente/editar">
        <h2>Editar Produto</h2>

        <input type="hidden" name="id" value="<?= $id ?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($nome) ?>" required>

        <label for="preco">Preço:</label>
        <input type="text" name="preco" id="preco" value="<?= htmlspecialchars($preco) ?>" required>

        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" id="categoria" value="<?= htmlspecialchars($categoria) ?>" required>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" rows="4"><?= htmlspecialchars($descricao) ?></textarea>

        <button type="submit">Salvar Alterações</button>
        <a href="index.php?pagina=gerente">Cancelar</a>
    </form>

</body>
</html>

<?php require __DIR__ . '/layout/footer.php'; ?>
