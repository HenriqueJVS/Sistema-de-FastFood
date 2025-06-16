<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>FastFood</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        <nav class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <h1>
                        <?php
                        switch ($_SESSION['usuario']->tipo) {
                            case 'gerente': echo 'Área do Gerente'; break;
                            case 'cliente': echo 'Área do Cliente'; break;
                            case 'atendente': echo 'Área do Atendente'; break;
                        }
                        ?>
                    </h1>
                <?php else: ?>
                    <h1>🍟 Bem-vindo ao FastFood</h1>
                <?php endif; ?>
            </div>
            <div>
                <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']->tipo === 'gerente'): ?>
                    <a href="index.php?pagina=gerente">Inicio</a>
                    <a href="index.php?pagina=gerente/salvar">➕ Adicionar Produto</a>
                    <a href="index.php?pagina=gerente/atendentes">👥 Gerenciar Atendentes</a>
                    <a href="index.php?pagina=logout">🔓 Logout</a>

                <?php elseif (isset($_SESSION['usuario']) && $_SESSION['usuario']->tipo === 'cliente'): ?>
                    <a href="index.php?pagina=logout">🔓 Logout</a>
                    <a href="index.php?pagina=cliente">Cardápio</a>
                    <a href="index.php?pagina=acompanhar">📦 Acompanhar Pedido</a>
                    <a href="index.php?pagina=carrinho" class="btn btn-warning btn-sm">🛒 Ver Carrinho</a>

                <?php elseif (isset($_SESSION['usuario']) && $_SESSION['usuario']->tipo === 'atendente'): ?>
                    <a href="index.php?pagina=atendente">Pedidos Recebidos</a>
                    <a href="index.php?pagina=atendente/historico_entregues">Histórico de Pedidos Entregues</a>
                    <a href="index.php?pagina=logout">🔓 Logout</a>

                <?php else: ?>
                    <a href="index.php">🏠 Home</a>
                    <a href="index.php?pagina=cardapio">🍔 Cardápio</a>
                    <a href="index.php?pagina=login">🔐 Login</a>
                    <a href="index.php?pagina=cadastro">📝 Cadastrar</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <div class="container flex-grow-1 my-4">
