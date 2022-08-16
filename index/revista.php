<!DOCTYPE html>
<?php
    require("../utils.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 0;
    $info = isset($_POST["info"]) ? $_POST["info"] : "";

    $vetor = listaRevista(1, $id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revista</title>
</head>
<body>
    <?php
        include_once("../menu.html");
    ?>
    <br>
    <form action="../control/ctrl_revista.php?id=<?php echo $id; ?>" method="post">
        Título: <input type="text" name="titulo" value="<?php if($acao == "editar") echo $vetor[0]["titulo"]; ?>"><br>
        <br>
        Resumo: <input type="text" name="resumo" value="<?php if($acao == "editar") echo $vetor[0]["resumo"]; ?>"><br>
        <br>
        Avaliação: <input type="text" name="avaliacao" value="<?php if($acao == "editar") echo $vetor[0]["avaliacao"]; ?>"><br>
        <br>
        Autores: <input type="text" name="autores" value="<?php if($acao == "editar") echo $vetor[0]["autores"]; ?>"><br>
        <br>
        Volume: <input type="text" name="volume" value="<?php if($acao == "editar") echo $vetor[0]["volume"]; ?>"><br>
        <br>
        Quantidade de avaliações: <input type="text" name="quant_avaliacoes" value="<?php if($acao == "editar") echo $vetor[0]["quant_avaliacoes"]; ?>"><br>
        <br>
        <button type="submit" name="acao" value="salvar">Salvar</button>
    </form>
    <br>
    <form method="post">
        <p>Pesquisar por:</p>
        <input type="radio" name="tipo" value="1" <?php if($tipo == 1) echo "checked"; ?>> ID <br>
        <input type="radio" name="tipo" value="2" <?php if($tipo == 2) echo "checked"; ?>> Título <br>
        <input type="radio" name="tipo" value="3" <?php if($tipo == 3) echo "checked"; ?>> Resumo <br>
        <input type="radio" name="tipo" value="4" <?php if($tipo == 4) echo "checked"; ?>> Avaliação <br>
        <input type="radio" name="tipo" value="5" <?php if($tipo == 5) echo "checked"; ?>> Autores <br>
        <input type="radio" name="tipo" value="6" <?php if($tipo == 6) echo "checked"; ?>> Volume <br>
        <input type="radio" name="tipo" value="7" <?php if($tipo == 7) echo "checked"; ?>> Quantidade de avaliações <br>
        <br>
        <input type="search" name="info" placeholder="Pesquisa" value="<?php echo $info; ?>"><br>
        <br>
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Resumo</th>
            <th>Avaliação</th>
            <th>Autores</th>
            <th>Volume</th>
            <th>Quantidade de avaliações</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php
            $lista = listaRevista($tipo, $info);
            foreach($lista as $linha){
        ?>
        <tr>
            <th><?php echo $linha["idrevista"]; ?></th>
            <td><?php echo $linha["titulo"]; ?></td>
            <td><?php echo $linha["resumo"]; ?></td>
            <td><?php echo number_format($linha["avaliacao"], 2, ",", "."); ?></td>
            <td><?php echo $linha["autores"]; ?></td>
            <td><?php echo $linha["volume"]; ?></td>
            <td><?php echo $linha["quant_avaliacoes"]; ?></td>
            <td><a href="avaliacao.php?obj=revista&id=<?php echo $linha["idrevista"]; ?>">Avaliar</a></td>
            <td><a href="revista.php?acao=editar&id=<?php echo $linha["idrevista"]; ?>">Editar</a></td>
            <td><a href="javascript:excluirRegistro('../control/ctrl_revista.php?acao=excluir&id=<?php echo $linha["idrevista"]; ?>')">Excluir</a></td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Este registro será excluído. Tem certeza?"))
            location.href = url;
    }
</script>