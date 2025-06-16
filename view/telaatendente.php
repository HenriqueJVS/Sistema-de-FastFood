<?php require __DIR__ . '/layout/header.php' ?>

<h2>Pedidos Recebidos</h2>

<?php foreach ($pedidos as $pedido): ?>
    <div style="border:1px solid #ccc; margin:10px; padding:10px;">
        <p><strong>Pedido #<?= $pedido->id ?></strong></p>

        <p>Data/Hora: <?= isset($pedido->criado_em) ? $pedido->criado_em : 'Data não disponível' ?></p>

        <p>Status: <?= $pedido->status ?></p>

        <p><u>Itens:</u></p>
        <ul>
            <?php if (!empty($pedido->itens)): ?>
                <?php foreach ($pedido->itens as $item): 
                    $subtotal = $item->quantidade * $item->preco_unitario;
                ?>
                    <li><?= $item->quantidade ?>x <?= $item->nome ?> - R$ <?= number_format($subtotal, 2, ',', '.') ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li><i>Nenhum item encontrado.</i></li>
            <?php endif; ?>
        </ul>

        <p><strong>Total: R$ <?= number_format($pedido->total, 2, ',', '.') ?></strong></p>

       <form method="post" action="index.php?pagina=atualizar_pedido">
    <input type="hidden" name="id_pedido" value="<?= $pedido->id ?>">

    <?php if ($pedido->status === 'pendente'): ?>
        <button type="submit" name="novo_status" value="em_preparo">Iniciar Preparo</button>
    <?php elseif ($pedido->status === 'em_preparo'): ?>
        <button type="submit" name="novo_status" value="pronto">Finalizar Preparo</button>
    <?php elseif ($pedido->status === 'pronto'): ?>
        <button type="submit" name="novo_status" value="entregue">Entregar</button>
    <?php endif; ?>
</form>


    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/layout/footer.php' ?>
