<?php

session_start();

require "../conexao-banco.php";

$id = $_GET["id"];

$nomeCategoria = filter_input(INPUT_POST, 'nomeCategoria');
$descricao = filter_input(INPUT_POST, 'descricao');

$sql = "UPDATE categoria SET CATEGORIA_NOME = :nomeCategoria, CATEGORIA_DESC = :descricao WHERE CATEGORIA_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":nomeCategoria", $nomeCategoria, PDO::PARAM_STR);
$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
$stmt->bindParam(":id", $id, PDO::PARAM_STR);

if($stmt->execute()){
    $_SESSION["msg"] = "Categoria alterada com sucesso!";
} else {
    $_SESSION["msg"] = "Erro ao alterar a categoria" . $stmt->errorInfo();
}

header("Location: ../../view/categorias.php");
