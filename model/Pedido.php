<?php

require_once __DIR__ . "/../config/Banco.php";

class Pedido
{

    public static function salvarPedido($itens, $formaPagamento, $idUsuario = null)
{
    $banco = Banco::pegarConexao();

    if (!$idUsuario && isset($_SESSION['usuario'])) {
        $idUsuario = $_SESSION['usuario']->id;
    }

    $formasValidas = ['dinheiro', 'pix', 'cartao_credito', 'cartao_debito'];

    if (!in_array($formaPagamento, $formasValidas)) {
        die('Forma de pagamento inválida.');
    }

    $queryPedido = "INSERT INTO pedidos (usuario_id, forma_pagamento, status) 
                    VALUES ($idUsuario, '$formaPagamento', 'pendente')";
    $banco->query($queryPedido);

    $idPedido = $banco->insert_id;

    foreach ($itens as $item) {
        if (!is_array($item) || !isset($item['id']) || !isset($item['quantidade'])) {
            continue;
        }

        $idProduto = (int)$item['id'];
        $quantidade = (int)$item['quantidade'];

        $resp = $banco->query("SELECT preco FROM produtos WHERE id = $idProduto");

        if ($resp && $obj = $resp->fetch_object()) {
            $preco = (float)$obj->preco;

            $queryItem = "INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, preco_unitario) 
                          VALUES ($idPedido, $idProduto, $quantidade, $preco)";
            $banco->query($queryItem);
        }
    }

    return $idPedido;
}

    public static function listarPedidosPendentes()
{
    $banco = Banco::pegarConexao();

    $res = $banco->query("
        SELECT id, usuario_id, status, criado_em 
        FROM pedidos 
        WHERE status IN ('pendente', 'em_preparo', 'pronto')
        ORDER BY id DESC
    ");

    $pedidos = [];
    while ($p = $res->fetch_object()) {
        $pedidos[] = $p;
    }

    return $pedidos;
}

    public static function listarItensDoPedido($idPedido)
{
    $banco = Banco::pegarConexao();

    $idPedido = (int)$idPedido;

    $query = "
        SELECT p.nome, ip.quantidade, ip.preco_unitario
        FROM itens_pedido ip
        JOIN produtos p ON p.id = ip.produto_id
        WHERE ip.pedido_id = $idPedido
    ";
    
    $resp = $banco->query($query);

    if (!$resp) {
        return [];
    }

    $itensDoPedido = [];
    while ($t = $resp->fetch_object()) {
        $itensDoPedido[] = $t;
    }

    return $itensDoPedido;
}



    public static function atualizarStatus($idPedido, $novoStatus)
    {
        $banco = Banco::pegarConexao();
        return $banco->query("UPDATE pedidos SET status = $novoStatus WHERE id = $idPedido");
        
    }
    
   public static function buscarPedidosEntreguesPorAtendente($idAtendente)
{
    $banco = Banco::pegarConexao();
    $idAtendente = (int)$idAtendente;

    $query = "
        SELECT * 
        FROM pedidos 
        WHERE atendente_id = $idAtendente AND status = 'entregue' 
        ORDER BY criado_em DESC
    ";

    $resultado = $banco->query($query);

    if (!$resultado) {
        return [];
    }

    $pedidos = [];

    while ($pedido = $resultado->fetch_object()) {
        $pedido->itens = self::listarItensDoPedido($pedido->id);
        $pedidos[] = $pedido;
    }

    return $pedidos;
}

public static function listarPedidosPorCliente($idCliente)
{
    $banco = Banco::pegarConexao();
    $pedidos = [];

    $query = "SELECT * FROM pedidos WHERE usuario_id = $idCliente ORDER BY criado_em DESC";
    $resp = $banco->query($query);

    while ($pedido = $resp->fetch_object()) {
        $pedido->itens = self::listarItensDoPedido($pedido->id);
        $pedidos[] = $pedido;
    }

    return $pedidos;
}

    

    
}
