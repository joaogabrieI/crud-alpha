<?php

session_start();

require "../conexao-banco.php";

$id = $_GET["id"];

$nomeCategoria = filter_input(INPUT_POST, 'nomeCategoria');
$descricao = filter_input(INPUT_POST, 'descricao');
$ativo = filter_input(INPUT_POST, 'ativo');

$sql = "UPDATE CATEGORIA SET CATEGORIA_NOME = :nomeCategoria, CATEGORIA_DESC = :descricao, CATEGORIA_ATIVO = :ativo WHERE CATEGORIA_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":nomeCategoria", $nomeCategoria, PDO::PARAM_STR);
$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
$stmt->bindParam(":ativo", $ativo, PDO::PARAM_STR);
$stmt->bindParam(":id", $id, PDO::PARAM_STR);

if($stmt->execute()){
    $_SESSION["msg"] = "Categoria alterada com sucesso!";
} else {
    $_SESSION["msg"] = "Erro ao alterar a categoria" . $stmt->errorInfo();
}

header("Location: ../../view/categorias.php");
