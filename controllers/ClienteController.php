<?php

require_once __DIR__ . '/../model/Pedido.php';
require_once __DIR__ . '/../model/Produto.php';


class ClienteController
{
    public static function exibirTelaCliente()
    {
        
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        require './view/TelaCliente.php';
    }

    public static function exibirCarrinho()
    {
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        $produtos = Produto::listarProdutos();

        require './view/Carrinho.php';
    }


    public static function adicionarAoCarrinho()
{
    session_start();

    if (!isset($_POST['id_produto']) || !isset($_POST['quantidade'])) {
        $_SESSION['mensagem_pedido'] = "Produto ou quantidade não informados.";
        header("Location: index.php?pagina=cliente");
        exit;
    }

    $idProduto = (int)$_POST['id_produto'];
    $quantidade = (int)$_POST['quantidade'];

    if ($idProduto <= 0 || $quantidade <= 0) {
        $_SESSION['mensagem_pedido'] = "Produto ou quantidade inválidos.";
        header("Location: index.php?pagina=cliente");
        exit;
    }

    if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    $_SESSION['carrinho'][] = [
        'id' => $idProduto,
        'quantidade' => $quantidade
    ];

    $_SESSION['mensagem_pedido'] = "Produto adicionado ao carrinho com sucesso.";
    header("Location: index.php?pagina=cliente");
    exit;
}


    public static function finalizarPedido()
{
    $banco = Banco::pegarConexao();

    if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho']) || $_SESSION['carrinho'] === []) {
        $_SESSION['mensagem_pedido'] = "Carrinho vazio. Adicione produtos antes de finalizar o pedido.";
        header("Location: index.php?pagina=cliente");
        exit;
    }

    if (!isset($_POST['forma_pagamento'])) {
        $_SESSION['mensagem_pedido'] = "Selecione uma forma de pagamento antes de finalizar o pedido.";
        header("Location: index.php?pagina=cliente");
        exit;
    }

    $formaPagamento = $_POST['forma_pagamento'];

    if ($formaPagamento === "" || $formaPagamento === null) {
        $_SESSION['mensagem_pedido'] = "Selecione uma forma de pagamento válida.";
        header("Location: index.php?pagina=cliente");
        exit;
    }

    $idPedido = Pedido::salvarPedido($_SESSION['carrinho'], $formaPagamento);

    unset($_SESSION['carrinho']);
    $_SESSION['mensagem_pedido'] = "Pedido #$idPedido realizado com sucesso!";

    header("Location: index.php?pagina=cliente");
    exit;
}

public static function atualizarQuantidade()
{
    if (isset($_POST['produto_id'], $_POST['quantidade'])) {
        $id = $_POST['produto_id'];
        $quantidade = max(1, (int)$_POST['quantidade']);

        foreach ($_SESSION['carrinho'] as &$item) {
            if ($item['id'] == $id) {
                $item['quantidade'] = $quantidade;
                break;
            }
        }
    }

    header('Location: index.php?pagina=carrinho');
    exit;
}

public static function removerItem()
{
    if (isset($_POST['produto_id'])) {
        $id = $_POST['produto_id'];
        $_SESSION['carrinho'] = array_filter($_SESSION['carrinho'], function ($item) use ($id) {
            return $item['id'] != $id;
        });
    }

    header('Location: index.php?pagina=carrinho');
    exit;
}


public static function buscarPedidos()
{
    require_once 'view/AcompanharPedido.php';
}


}
