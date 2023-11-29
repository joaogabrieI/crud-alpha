<?php
session_start();

require "../conexao-banco.php";

$id = $_GET["id"];

$sql = "DELETE FROM ADMINISTRADOR WHERE ADM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);

if($stmt->execute()){
    $_SESSION["erroLogin"] = "Usuário excluído com sucesso!";
} else {
    $_SESSION["erroLogin"] = "Erro ao excluir o usuário" . $stmt->errorInfo();
}

header("Location: ../login-cadastro/logout.php");