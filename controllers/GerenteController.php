<?php

require_once __DIR__ . '/../model/Produto.php';

class GerenteController
{
    public static function exibirTelaGerente()
    {
        $produtos = Produto::listarProdutos();
        require './view/TelaGerente.php';
    }

    public static function salvarProduto()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $imagemPath = null;

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $nomeImagem = basename($_FILES['imagem']['name']);
        $caminhoDestino = 'assets/img/' . $nomeImagem;

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
        $imagemPath = $nomeImagem;
    }
}

    Produto::salvar(
        $_POST['nome'],
        $_POST['preco'],
        $_POST['categoria'],
        $_POST['descricao'],
        $imagemPath
    );

        $_SESSION['mensagem'] = "Produto adicionado com sucesso!";
        header("Location: index.php?pagina=gerente");
        exit;
    }

    require './view/CriarProduto.php';
}




    public static function editarProduto()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        Produto::editar(
            $_POST['id'],
            $_POST['nome'],
            $_POST['preco'],
            $_POST['categoria'],
            $_POST['descricao']
        );
        $_SESSION['mensagem'] = "Produto atualizado com sucesso!";
        header("Location: index.php?pagina=gerente");
        exit;

    }

    if (isset($_GET['id'])) {
    $produto = Produto::buscarPorId($_GET['id']);
    require './view/EditarProduto.php';
}
}


    public static function excluirProduto()
{
    if (isset($_GET['id'])) {
        Produto::excluir($_GET['id']);
    }

    header("Location: index.php?pagina=gerente");
    exit;
}

    public static function exibirDetalhesProduto()
    {
        if (!isset($_GET['id'])) {
            echo "<p>Produto não encontrado.</p>";
            return;
        }

        $id = $_GET['id'];
        $produto = Produto::buscarPorId($id);

        if (!$produto) {
            echo "<p>Produto não encontrado.</p>";
            return;
        }

        require './view/DetalhesProduto.php';
    }

    public static function listarAtendentes()
{
    $atendentes = Usuario::listarPorTipo('atendente');
    require './view/AtendentesGerente.php';
}

public static function adicionarAtendente()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        Usuario::cadastrar(
            $_POST['nome'],
            $_POST['email'],
            $_POST['senha'],
            $_POST['cpf'],
            $_POST['data_nascimento'],
            'atendente',
        );
        header('Location: index.php?pagina=gerente/atendentes');
        exit;
    }
    require './view/FormAtendente.php';
}

public static function editarAtendente()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        Usuario::atualizarAtendente(
            $_POST['id'],
            $_POST['nome'],
            $_POST['email'],
            $_POST['cpf'],
            $_POST['data_nascimento'],
        );
        header('Location: index.php?pagina=gerente/atendentes');
        exit;
    }

    if (isset($_GET['id'])) {
        $atendente = Usuario::buscarPorId($_GET['id']);
        require './view/FormAtendente.php';
    }
}

public static function excluirAtendente()
{
    if (isset($_GET['id'])) {
        Usuario::excluir($_GET['id']);
    }
    header('Location: index.php?pagina=gerente/atendentes');
    exit;
}

}



