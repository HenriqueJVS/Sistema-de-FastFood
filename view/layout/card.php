<?php
function exibirCard($produto)
{
    echo "<div class='card m-2' style='width: 200px;'>";

    $caminhoImagem = 'assets/img/' . htmlspecialchars($produto->imagem ?? 'sem-imagem.png');
    echo "<img src='$caminhoImagem' class='card-img-top' alt='Imagem do produto'>";

    echo "<div class='card-body text-center'>";
    echo "<h5 class='card-title'>" . htmlspecialchars($produto->nome) . "</h5>";
    echo "<p class='card-text'>R$ " . number_format($produto->preco, 2, ',', '.') . "</p>";

    echo "<a href='index.php?pagina=produto_detalhe&id={$produto->id}' class='btn btn-primary btn-sm mb-2'>Ver Detalhes</a><br>";

    if (isset($_SESSION['usuario']) && $_SESSION['usuario']->tipo === 'cliente') {
        echo "<form method='post' action='index.php?pagina=adicionar_carrinho'>
                <input type='hidden' name='produto_id' value='{$produto->id}'>
                <button type='submit' class='btn btn-success btn-sm'>Adicionar</button>
              </form>";
    }

    if (isset($_SESSION['usuario']) && $_SESSION['usuario']->tipo === 'gerente') {
        echo "<a href='index.php?pagina=gerente/editar&id={$produto->id}' class='btn btn-warning btn-sm mb-1 d-block'>Editar</a>";

        echo "<form method='get' action='index.php'>
                <input type='hidden' name='pagina' value='gerente/excluir'>
                <input type='hidden' name='excluir' value='{$produto->id}'>
                <button type='submit' class='btn btn-danger btn-sm d-block'>Excluir</button>
              </form>";
    }

    echo "</div></div>";
}

?>
