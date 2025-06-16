<?php

require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../model/Produto.php';


class HomeController
{
  public static function exibirTelaInicial()
{
    require './view/layout/header.php';
    require './view/Home.php';
}

    public static function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usuario = Usuario::buscarPorLogin($email, $senha);

        if ($usuario) {
            session_start();
            $_SESSION['usuario'] = $usuario;

            switch ($usuario->tipo) {
                case 'gerente':
                    header('Location: index.php?pagina=gerente');
                    break;
                case 'atendente':
                    header('Location: index.php?pagina=atendente');
                    break;
                default:
                    header('Location: index.php?pagina=cliente');
                    break;
            }
            exit;
        } else {
            echo "Usuário ou senha inválidos!";
        }
    }

    require './view/Login.php';
}


    public static function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $cpf = $_POST['cpf'];
            $dataNascimento = $_POST['data_nascimento'];

            Usuario::cadastrar($nome, $email, $senha, $cpf, $dataNascimento);
            header('Location: index.php?pagina=login');
            exit;
        }

        require './view/Cadastro.php';
    }

    public static function recuperarSenha()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cpf = $_POST['cpf'];
            $data = $_POST['data_nascimento'];

            $usuario = Usuario::buscarPorCpfData($cpf, $data);
            if ($usuario) {
                echo "Senha protegida. Não é possível exibir por segurança.";
            } else {
                echo "Dados incorretos!";
            }
        }

        require './view/RecuperarSenha.php';
    }

    public static function logout() {
    session_start();
    unset($_SESSION['user_id']);
    unset($_SESSION['user']);
    unset($_SESSION['usuario']);
    session_destroy();

    header('Location: index.php?pagina=login');
    exit;
}

public static function exibirCardapio()
{
    require 'view/Cardapio.php';
}


}
