<?php
    require_once("../autoload.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    if($acao == "excluir"){
        try{
            $livro = new Livro($id, 1, 1, 1, 1, 1);
            $livro->excluir();
            header("location:../index/livro.php");
        } catch(Exception $e){
            echo "Erro ao excluir livro <br>".
                "<br>".
                $e->getMessage();
        }
    }

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    if($acao == "salvar"){
        $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
        $resumo = isset($_POST["resumo"]) ? $_POST["resumo"] : "";
        $avaliacao = isset($_POST["avaliacao"]) ? $_POST["avaliacao"] : 0;
        $autores = isset($_POST["autores"]) ? $_POST["autores"] : "";
        $ano_publicacao = isset($_POST["ano_publicacao"]) ? $_POST["ano_publicacao"] : 0;
        $livro = new Livro($id, $titulo, $resumo, $avaliacao, $autores, $ano_publicacao);
        if($id == 0){
            try{
                $livro->insere();
            } catch(Exception $e){
                echo "Erro ao cadastrar livro <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $livro->editar();
            } catch(Exception $e){
                echo "Erro ao editar os dados do livro <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
        header("location:../index/livro.php");
    }

    if($acao == "avaliar"){
        $nota = isset($_POST["nota"]) ? $_POST["nota"] : 0;
        $livro = new Livro($id, 1, 1, 1, 1, 1);
        $livro->avaliar($id, $nota);
        header("location:../index/livro.php");
    }
?>