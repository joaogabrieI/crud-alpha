<?php
session_start();

require "../conexao-banco.php";

$id = $_GET["id"];

$sql = "DELETE FROM administrador WHERE ADM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);

if($stmt->execute()){
    $_SESSION["msg"] = "Usuário excluído com sucesso!";
} else {
    $_SESSION["msg"] = "Erro ao excluir o usuário" . $stmt->errorInfo();
}

header("Location: ../../view/usuarios.php");