<?php

require_once __DIR__ . '/../model/Pedido.php';

class AtendenteController
{
    static function exibirTelaAtendente()
{
    $pedidos = Pedido::listarPedidosPendentes();

    foreach ($pedidos as &$pedido) {
        $itens = Pedido::listarItensDoPedido($pedido->id);
        $pedido->itens = $itens;

        $total = 0;
        foreach ($itens as $item) {
            $total += $item->quantidade * $item->preco_unitario;
        }
        $pedido->total = $total;
    }

    require './view/TelaAtendente.php';
}



   public static function atualizarStatusPedido()
{
    $banco = Banco::pegarConexao();

    $id = (int)($_POST['id_pedido'] ?? 0);
    $novoStatus = $_POST['novo_status'] ?? '';

    $statusValidos = ['pendente', 'em_preparo', 'pronto', 'entregue'];

    if (!in_array($novoStatus, $statusValidos)) {
        echo "Status inválido recebido: <strong>" . htmlspecialchars($novoStatus) . "</strong>";
        exit;
    }

    $idAtendente = $_SESSION['usuario']->id;
    $banco->query("UPDATE pedidos SET status = '$novoStatus', atendente_id = $idAtendente WHERE id = $id");


    header('Location: index.php?pagina=atendente');
    exit;
}

    public static function exibirHistoricoEntregues() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->tipo !== 'atendente') {
            header("Location: index.php");
            exit;
        }
        $idAtendente = $_SESSION['usuario']->id;
        
        require_once 'model/Pedido.php';
        $pedidos = Pedido::buscarPedidosEntreguesPorAtendente($idAtendente);

        include 'view/HistoricoEntregues.php';
}



}
?>      