<?php require __DIR__ . '/layout/header.php'; ?>
<h2>Adicionar Produto</h2>

<form action="index.php?pagina=gerente/salvar" method="post" enctype="multipart/form-data">
    <label>Nome:</label>
    <input type="text" name="nome" required><br><br>

    <label>Preço:</label>
    <input type="number" step="0.01" name="preco" required><br><br>

    <label>Categoria:</label>
    <input type="text" name="categoria" required><br><br>

    <label>Descrição:</label>
    <textarea name="descricao" required></textarea><br><br>

    <label>Imagem:</label>
    <input type="file" name="imagem" accept="image/*" required><br><br>

    <button type="submit">Salvar Produto</button>
</form>

<?php require __DIR__ . '/layout/footer.php' ?>
