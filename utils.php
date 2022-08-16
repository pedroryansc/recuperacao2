<?php
    require_once("autoload.php");

    function listaLivro($tipo, $info){
        $livro = new Livro(1, 1, 1, 1, 1, 1);
        $lista = $livro->listar($tipo, $info);
        return $lista;
    }

    function listaRevista($tipo, $info){
        $rev = new Revista(1, 1, 1, 1, 1, 1, 1);
        $lista = $rev->listar($tipo, $info);
        return $lista;
    }
?>