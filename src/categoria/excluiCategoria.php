<?php
session_start();

require "../conexao-banco.php";

$id = $_GET["id"];

$sql = "DELETE FROM categoria WHERE CATEGORIA_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);

if($stmt->execute()){
    $_SESSION["msg"] = "Categoria excluída com sucesso!";
} else {
    $_SESSION["msg"] = "Erro ao excluir categoria" . $stmt->errorInfo();
}

header("Location: ../../view/categorias.php");