<?php
session_start();

require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/GerenteController.php';
require_once __DIR__ . '/controllers/AtendenteController.php';
require_once __DIR__ . '/controllers/ClienteController.php';

$pagina = $_GET['pagina'] ?? 'home';

if ($pagina === 'cliente' && (!isset($_SESSION['usuario']) || $_SESSION['usuario']->tipo !== 'cliente')) {
    header('Location: index.php?pagina=login');
    exit;
}

if (($pagina === 'atendente' || $pagina === 'atualizar_pedido') && (!isset($_SESSION['usuario']) || $_SESSION['usuario']->tipo !== 'atendente')) {
    header('Location: index.php?pagina=login');
    exit;
}

if ($pagina === 'gerente' && (!isset($_SESSION['usuario']) || $_SESSION['usuario']->tipo !== 'gerente')) {
    header('Location: index.php?pagina=login');
    exit;
}



match ($pagina) {
    'login'                             => HomeController::login(),
    'cadastro'                          => HomeController::cadastrar(),
    'recuperar_senha'                   => HomeController::recuperarSenha(),
    'logout'                            => HomeController::logout(),
    'cardapio'                          => HomeController::exibirCardapio(), 

    'cliente'                           => ClienteController::exibirTelaCliente(),
    'adicionar_carrinho'                => ClienteController::adicionarAoCarrinho(),
    'carrinho'                          => ClienteController::exibirCarrinho(),
    'finalizar_pedido'                  => ClienteController::finalizarPedido(),
    'atualizar_quantidade'              => ClienteController::atualizarQuantidade(),
    'remover_item'                      => ClienteController::removerItem(),
    'acompanhar'                        => ClienteController::buscarPedidos(),
      
    'atendente'                         => AtendenteController::exibirTelaAtendente(),
    'atualizar_pedido'                  => AtendenteController::atualizarStatusPedido(),
    'atendente/historico_entregues'     => AtendenteController::exibirHistoricoEntregues(),

    'gerente'                           => GerenteController::exibirTelaGerente(),
    'gerente/salvar'                    => GerenteController::salvarProduto(),
    'gerente/editar'                    => GerenteController::editarProduto(),
    'gerente/excluir'                   => GerenteController::excluirProduto(),
    'produto_detalhe'                   => GerenteController::exibirDetalhesProduto(),
    'gerente/atendentes'                => GerenteController::listarAtendentes(),
    'gerente/adicionar_atendente'       => GerenteController::adicionarAtendente(),
    'gerente/editar_atendente'          => GerenteController::editarAtendente(),
    'gerente/excluir_atendente'         => GerenteController::excluirAtendente(),


    default                             => HomeController::exibirTelaInicial()
};
