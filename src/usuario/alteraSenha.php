<?php
session_start();

require "../conexao-banco.php";

$id = $_GET["id"];

$sql = "SELECT * FROM ADMINISTRADOR WHERE ADM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($usuarios as $usuario) {
    $idUsuario = $usuario["ADM_ID"];
}

$senha = filter_input(INPUT_POST, 'senha');
$senhaConfirmada = filter_input(INPUT_POST, 'senha2');

if ($senha != $senhaConfirmada) {
    $_SESSION["msg"] = "As Senhas digitadas não são iguais.";
    header("Location:../../view/alteraSenhaForm.php?id=$idUsuario");
    exit;
} else {
    $senha = password_hash($senha, PASSWORD_DEFAULT);
}

$sql = "UPDATE ADMINISTRADOR SET ADM_SENHA = :senha WHERE ADM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    $_SESSION["msg"] = "Senha alterada com sucesso!";
} else {
    $_SESSION["msg"] = "Erro ao alterar a senha." . $stmt->errorInfo();
}

header("Location: ../../view/alteraSenhaForm.php?id=$idUsuario");
