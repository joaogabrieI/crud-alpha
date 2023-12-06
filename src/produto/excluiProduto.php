<?php

session_start();

require "../conexao-banco.php";

$id = $_GET["id"];

$sql = "UPDATE PRODUTO SET PRODUTO_ATIVO = 0 WHERE PRODUTO_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);

if($stmt->execute()){
    $_SESSION["msg"] = "Produto desativado com sucesso!";
    header("Location: ../../view/produtos.php");
} else {
    $_SESSION["msg"] = $pdo->errorInfo();
    header("Location: ../../view/produtos.php");
}