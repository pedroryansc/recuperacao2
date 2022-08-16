<?php
    require_once("../autoload.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    if($acao == "excluir"){
        try{
            $rev = new Revista($id, 1, 1, 1, 1, 1, 1);
            $rev->excluir();
            header("location:../index/revista.php");
        } catch(Exception $e){
            echo "Erro ao excluir revista <br>".
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
        $volume = isset($_POST["volume"]) ? $_POST["volume"] : 0;
        $quant_avaliacoes = isset($_POST["quant_avaliacoes"]) ? $_POST["quant_avaliacoes"] : 0;
        $rev = new Revista($id, $titulo, $resumo, $avaliacao, $autores, $volume, $quant_avaliacoes);
        if($id == 0){
            try{
                $rev->insere();
            } catch(Exception $e){
                echo "Erro ao cadastrar revista <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $rev->editar();
            } catch(Exception $e){
                echo "Erro ao editar os dados da revista <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
        header("location:../index/revista.php");
    }

    if($acao == "avaliar"){
        $nota = isset($_POST["nota"]) ? $_POST["nota"] : 0;
        $rev = new Revista($id, 1, 1, 1, 1, 1, 1);
        $rev->avaliar($id, $nota);
        header("location:../index/revista.php");
    }
?>