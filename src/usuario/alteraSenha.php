<?php
session_start();

require "../conexao-banco.php";

$id = $_GET["id"];

$sql = "SELECT * FROM administrador WHERE adm_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($usuarios as $usuario) {
    $idUsuario = $usuario["adm_id"];
}

$senha = filter_input(INPUT_POST, 'senha');
$senhaConfirmada = filter_input(INPUT_POST, 'senha2');

if ($senha != $senhaConfirmada) {
    $_SESSION["msg"] = "as senhas não são iguais";
    header("Location: alteraSenhaForm.php?id=$idUsuario");
    exit;
} else {
    $senha = password_hash($senha, PASSWORD_DEFAULT);
}

$sql = "UPDATE administrador SET adm_senha = :senha WHERE adm_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    $_SESSION["msg"] = "Senha alterada com sucesso!";
} else {
    $_SESSION["msg"] = "Erro ao alterar a senha" . $stmt->errorInfo();
}

header("Location: alteraSenhaForm.php?id=$idUsuario");
