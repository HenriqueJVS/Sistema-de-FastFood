<?php

require_once __DIR__ . '/../config/Banco.php';

class Produto
{
    public static function listarProdutos()
    {
        $banco = Banco::pegarConexao();
        $res = $banco->query("SELECT * FROM produtos");

        $produtos = [];
        while ($t = $res->fetch_object()) {
            $produtos[] = $t;
        }

        return $produtos;
    }



    public static function buscarPorId($id) {
        $banco = Banco::pegarConexao();
        $res = $banco->query("SELECT * FROM produtos WHERE id=$id");

        if ($res->num_rows > 0) {
            return $res->fetch_object();
        } else {
            return null;
        }
    }

    public static function salvar($nome, $preco, $categoria, $descricao, $imagem)
    {
        $banco = Banco::pegarConexao();

        $sql = "INSERT INTO produtos (nome, preco, categoria, descricao, imagem) 
                VALUES ('$nome', $preco, '$categoria', '$descricao', '$imagem')";

        return $banco->query($sql);
    }


    public static function editar($id, $nome, $preco, $categoria, $descricao)
    {
        $banco = Banco::pegarConexao();
        $sql = "UPDATE produtos 
                SET nome='$nome', preco=$preco, categoria='$categoria', descricao='$descricao' 
                WHERE id=$id";
        return $banco->query($sql);
    }


    public static function excluir($id)
    {
        $banco = Banco::pegarConexao();
        return $banco->query("DELETE FROM produtos WHERE id = $id");
    }

    
    
}
