<?php
session_start();

require '../conexao-banco.php';
$id = $_GET["id"];

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');

$sql = "UPDATE ADMINISTRADOR SET ADM_NOME = :nome, ADM_EMAIL = :email WHERE ADM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->bindParam(":id", $id, PDO::PARAM_STR);

if($stmt->execute()){
    $_SESSION["msg"] = "Usuário alterado com sucesso!";
} else {
    $_SESSION["msg"] = "Erro ao alterar o usuário" . $stmt->errorInfo();
}

header("Location: ../../view/usuarios.php");
