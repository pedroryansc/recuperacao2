<!DOCTYPE html>
<?php
    require("../utils.php");

    $obj = isset($_GET["obj"]) ? $_GET["obj"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação</title>
</head>
<body>
    <?php
        include_once("../menu.html");

        if($obj == "livro"){
            $vetor = listaLivro(1, $id);
            $livro = new Livro($vetor[0]["idlivro"], $vetor[0]["titulo"], $vetor[0]["resumo"],
                                $vetor[0]["avaliacao"], $vetor[0]["autores"], $vetor[0]["ano_publicacao"]);
            echo "<br>".$livro;
        } else if($obj == "revista"){
            $vetor = listaRevista(1, $id);
            $rev = new Revista($vetor[0]["idrevista"], $vetor[0]["titulo"], $vetor[0]["resumo"], $vetor[0]["avaliacao"],
                                $vetor[0]["autores"], $vetor[0]["volume"], $vetor[0]["quant_avaliacoes"]);
            echo "<br>".$rev;
        }
    ?>
    <br>
    <form action="../control/ctrl_<?php echo $obj; ?>.php?id=<?php echo $id; ?>" method="post">
        Avaliação: <input type="text" name="nota"><br>
        <br>
        <button type="submit" name="acao" value="avaliar">Avaliar</button>
    </form>
</body>
</html>