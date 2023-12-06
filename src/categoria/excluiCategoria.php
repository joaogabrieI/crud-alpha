<?php
session_start();

require "../conexao-banco.php";

$id = $_GET["id"];

$sql = "UPDATE CATEGORIA SET CATEGORIA_ATIVO = 0 WHERE CATEGORIA_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);

if($stmt->execute()){
    $_SESSION["msg"] = "Categoria desativada com sucesso!";
} else {
    $_SESSION["msg"] = "Erro ao excluir categoria" . $stmt->errorInfo();
}

header("Location: ../../view/categorias.php");