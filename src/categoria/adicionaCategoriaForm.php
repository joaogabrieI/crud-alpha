<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="adicionaCategoria.php" method="post">
        <label for="nomeCategoria">Nome categoria: </label>
        <input type="text" name="nomeCategoria">

        <label for="descricao">Descrição: </label>
        <input type="text" name="descricao">

        <input type="submit" value="Adicionar">
    </form>
    <p><?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?></p>
    <a href="categorias.php">Voltar</a>
</body>

</html>