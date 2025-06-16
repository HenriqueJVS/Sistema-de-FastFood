<?php require __DIR__ . '/layout/header.php'; ?>

<div class="container mt-4">
    <h2><?= htmlspecialchars($produto->nome) ?></h2>

    <?php if (!empty($produto->imagem)): ?>
        <img src="assets/img/<?= htmlspecialchars($produto->imagem) ?>" 
             alt="<?= htmlspecialchars($produto->nome) ?>" 
             class="img-fluid mb-3" style="max-width: 300px;">
    <?php else: ?>
        <p><em>Sem imagem disponível.</em></p>
    <?php endif; ?>

    <p><strong>Categoria:</strong> <?= htmlspecialchars($produto->categoria) ?></p>
    <p><strong>Preço:</strong> R$ <?= number_format($produto->preco, 2, ',', '.') ?></p>
    <p><strong>Descrição:</strong> <?= htmlspecialchars($produto->descricao) ?></p>
</div>

<?php require __DIR__ . '/layout/footer.php'; ?>
