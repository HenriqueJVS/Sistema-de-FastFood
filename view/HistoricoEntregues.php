<?php require __DIR__ . '/layout/header.php'; ?>

<h2>Histórico de Pedidos Entregues</h2>

<?php if (empty($pedidos)): ?>
    <p>Nenhum pedido entregue encontrado.</p>
<?php else: ?>
    <?php foreach ($pedidos as $pedido): ?>
        <div style="border:1px solid #ccc; margin:10px; padding:10px;">
            <p><strong>Pedido #<?= $pedido->id ?></strong></p>
            <p>Data/Hora: <?= $pedido->criado_em ?></p>
            <p><u>Itens:</u></p>
            <ul>
                <?php foreach ($pedido->itens as $item): ?>
                    <li><?= $item->nome ?> - Qtd: <?= $item->quantidade ?></li>
                <?php endforeach; ?>
            </ul>
            <p>Status: <?= ucfirst($pedido->status) ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php require __DIR__ . '/layout/footer.php'; ?>