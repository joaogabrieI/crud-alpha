<?php

session_start();

require "../conexao-banco.php";

$id = $_GET["id"];
$produto_id = $_GET['produto'];

$sql = "DELETE FROM PRODUTO_IMAGEM WHERE IMAGEM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);

if($stmt->execute()){
    $_SESSION["msg"] = "Imagem excluída com sucesso!";
} else {
    $_SESSION["msg"] = "Erro ao excluir a imagem" . $stmt->errorInfo();
}

header("Location: ../../view/ordenaImagensForm.php?id=".$produto_id);