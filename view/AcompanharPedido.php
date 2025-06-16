<?php
require_once 'layout/header.php';
require_once 'model/Pedido.php';

if (!isset($_SESSION['usuario'])) {
    echo "<div class='container mt-4 alert alert-warning'>Você precisa estar logado para ver seus pedidos.</div>";
    require_once 'layout/footer.php';
    return;
}

$idCliente = $_SESSION['usuario']->id;
$pedidos = Pedido::listarPedidosPorCliente($idCliente);
?>

<div class="container mt-4">
    <h2 class="mb-4">📦 Acompanhamento dos seus Pedidos</h2>

    <?php if (empty($pedidos)): ?>
        <div class="alert alert-info">Você ainda não realizou nenhum pedido.</div>
    <?php else: ?>
        <?php foreach ($pedidos as $pedido): ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <strong>Pedido #<?= $pedido->id ?></strong>
                    <span class="badge bg-info text-dark float-end"><?= ucfirst($pedido->status) ?></span>
                </div>
                <div class="card-body">
                    <p><strong>Data do Pedido:</strong> <?= $pedido->criado_em ?></p>
                    <p><strong>Forma de Pagamento:</strong> <?= ucfirst($pedido->forma_pagamento) ?></p>
                    <p><strong>Itens:</strong></p>
                    <ul>
                        <?php foreach ($pedido->itens as $item): ?>
                            <li><?= htmlspecialchars($item->nome) ?> (<?= $item->quantidade ?>x)</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once 'layout/footer.php'; ?>