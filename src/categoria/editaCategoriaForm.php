<?php 
session_start(); 

require "../conexao-banco.php";

$id = $_GET["id"];

$sql = "SELECT * FROM administrador WHERE ADM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php foreach ($usuarios as $usuario): ?> 
    <form action="editaCategoria.php" method="post">
        <label for="nomeCategoria">Nome categoria: </label>
        <input type="text" name="nomeCategoria" value="<?= $usuario["CATEGORIA_NOME"]?>">

        <label for="descricao">Descrição: </label>
        <input type="text" name="descricao" value="<?= $usuario["CATEGORIA_DESC"]?>">

        <input type="submit" value="Adicionar">
    </form>
    <?php endforeach ?>
    <p><?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?></p>
    <a href="categorias.php">Voltar</a>
</body>

</html>