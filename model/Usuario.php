<?php
require_once __DIR__ . '/../config/Banco.php';

class Usuario
{
    public static function buscarPorCpfData($cpf, $dataNascimento)
    {
        $banco = Banco::pegarConexao();
        $resp = $banco->query("SELECT * FROM usuarios WHERE cpf = '$cpf' AND data_nascimento = '$dataNascimento'");
        return ($resp->num_rows > 0) ? $resp->fetch_object() : null;
    }

    public static function buscarPorLogin($email, $senha)
    {
        $banco = Banco::pegarConexao();
        $resp = $banco->query("SELECT * FROM usuarios WHERE email = '$email'");
        if ($resp->num_rows > 0) {
            $usuario = $resp->fetch_object();
            if (password_verify($senha, $usuario->senha)) {
                return $usuario;
            }
        }
        return null;
    }

    public static function cadastrar($nome, $email, $senha, $cpf, $dataNascimento, $tipo = 'cliente')
    {
        $banco = Banco::pegarConexao();
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        return $banco->query("INSERT INTO usuarios (nome, email, senha, cpf, data_nascimento, tipo) 
                             VALUES ('$nome', '$email', '$senhaHash', '$cpf', '$dataNascimento', '$tipo')");
    }

    public static function listarPorTipo($tipo)
    {
        $banco = Banco::pegarConexao();
        $res = $banco->query("SELECT * FROM usuarios WHERE tipo = '$tipo'");
        $lista = [];
        while ($u = $res->fetch_object()) {
            $lista[] = $u;
        }
        return $lista;
    }

    public static function atualizarAtendente($id, $nome, $email, $cpf, $dataNascimento)
    {
        $banco = Banco::pegarConexao();
        $banco->query("
            UPDATE usuarios 
            SET nome = '$nome', email = '$email', cpf = '$cpf', data_nascimento = '$dataNascimento' 
            WHERE id = $id AND tipo = 'atendente'
        ");
    }

    public static function excluir($id)
    {
        $banco = Banco::pegarConexao();
        return $banco->query("DELETE FROM usuarios WHERE id = $id AND tipo = 'atendente'");
    }

    public static function buscarPorId($id)
    {
        $banco = Banco::pegarConexao();
        $res = $banco->query("SELECT * FROM usuarios WHERE id = $id");

        if ($res->num_rows > 0) {
            return $res->fetch_object();
        } else {
            return null;
        }
    }
}
