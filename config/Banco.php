<?php

abstract class Banco
{
    private static $conexao;

    public static function pegarConexao()
    {
        if (!isset(self::$conexao)) {
            self::$conexao = new mysqli("localhost:3307", "root", "", "fastfood");

            if (self::$conexao->connect_error) {
                die("Erro ao conectar ao banco: " . self::$conexao->connect_error);
            }
        }

        return self::$conexao;
    }
}
