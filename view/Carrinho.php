<?php require __DIR__ . '/layout/header.php'; ?>

<div class="container mt-4">
    <h3 class="mb-4">🛒 Carrinho</h3>

    <?php if (!isset($_SESSION['carrinho']) || $_SESSION['carrinho'] === []): ?>
        <div class="alert alert-info">O carrinho está vazio.</div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Produto</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $produtos = Produto::listarProdutos();
                $total = 0;

                foreach ($_SESSION['carrinho'] as $itemCarrinho):
                    foreach ($produtos as $produto):
                        if ($produto->id == $itemCarrinho['id']):
                            $subtotal = $produto->preco * $itemCarrinho['quantidade'];
                            $total += $subtotal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($produto->nome) ?></td>
                        <td>R$ <?= number_format($produto->preco, 2, ',', '.') ?></td>
                        <td>
                            <form action="index.php?pagina=atualizar_quantidade" method="post" class="d-flex align-items-center">
                                <input type="hidden" name="produto_id" value="<?= $produto->id ?>">
                                <input type="number" name="quantidade" value="<?= $itemCarrinho['quantidade'] ?>" min="1" class="form-control form-control-sm me-2" style="width: 80px;">
                                <button type="submit" class="btn btn-sm btn-primary">Atualizar</button>
                            </form>
                        </td>
                        <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                        <td>
                            <form action="index.php?pagina=remover_item" method="post">
                                <input type="hidden" name="produto_id" value="<?= $produto->id ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php
                        break;
                        endif;
                    endforeach;
                endforeach;
                ?>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2"><strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></td>
                </tr>
            </tbody>
        </table>

        <form method="post" action="index.php?pagina=finalizar_pedido" class="mt-4">
            <div class="mb-3">
                <label class="form-label">Forma de Pagamento:</label>
                <select name="forma_pagamento" class="form-select" required>
                    <option value="">Selecione...</option>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="pix">Pix</option>
                    <option value="cartao_debito">Cartão de Débito</option>
                    <option value="cartao_credito">Cartão de Crédito</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Finalizar Pedido</button>
        </form>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/layout/footer.php'; ?>

