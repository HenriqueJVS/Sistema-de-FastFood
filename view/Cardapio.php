<?php
require_once 'layout/header.php';
$produtos = Produto::listarProdutos();
?>

<div class="container">
    <h2 class="text-center my-4">Cardápio</h2>

    <div class="row justify-content-center">
        <?php foreach ($produtos as $produto): ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 text-center shadow-sm">

                    <?php
                    $imagem = htmlspecialchars($produto->imagem ?: 'sem-imagem.png');
                    ?>

                    <img src="assets/img/<?= $imagem ?>" class="card-img-top" alt="<?= htmlspecialchars($produto->nome) ?>" style="height: 180px; object-fit: contain;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($produto->nome) ?></h5>
                        <p class="card-text">R$ <?= number_format($produto->preco, 2, ',', '.') ?></p>

                        <a href="index.php?pagina=produto_detalhe&id=<?= $produto->id ?>" class="btn btn-primary btn-sm mb-2">Ver Detalhes</a>

                        <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']->tipo === 'cliente'): ?>
                            <form method="post" action="index.php?pagina=adicionar_carrinho" class="mt-auto">
                                <input type="hidden" name="id_produto" value="<?= $produto->id ?>">
                                <div class="input-group input-group-sm mb-2">
                                    <input type="number" name="quantidade" class="form-control" value="1" min="1" required>
                                    <button type="submit" class="btn btn-success">Adicionar</button>
                                </div>
                            </form>
                        <?php elseif (isset($_SESSION['usuario']) && $_SESSION['usuario']->tipo === 'gerente'): ?>
                            <div class="d-grid gap-2">
                                <a href="index.php?pagina=gerente/editar&id=<?= $produto->id ?>" class="btn btn-outline-primary btn-sm">Editar</a>
                                <a href="index.php?pagina=gerente/excluir&id=<?= $produto->id ?>" class="btn btn-outline-danger btn-sm">Excluir</a>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
