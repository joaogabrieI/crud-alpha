<?php

session_start();

require "../conexao-banco.php";

$id = $_GET["id"];

$nome = filter_input(INPUT_POST, "nome", FILTER_DEFAULT);
$descricao = filter_input(INPUT_POST, "descricao", FILTER_DEFAULT);
$preco = str_replace(',', '.',filter_input(INPUT_POST, "preco", FILTER_DEFAULT));
$desconto = str_replace(',', '.',filter_input(INPUT_POST, "desconto", FILTER_DEFAULT));
$categoria = filter_input(INPUT_POST, "categoria", FILTER_DEFAULT);
$qtd = filter_input(INPUT_POST, "qtd", FILTER_DEFAULT);
$ativo = filter_input(INPUT_POST, "ativo", FILTER_DEFAULT);

$sql = "UPDATE PRODUTO SET PRODUTO_NOME = :nome, PRODUTO_DESC = :descricao, PRODUTO_PRECO = :preco, PRODUTO_DESCONTO = :desconto, CATEGORIA_ID = :categoria, PRODUTO_ATIVO = :ativo WHERE PRODUTO_ID = :id;
UPDATE PRODUTO_ESTOQUE SET PRODUTO_QTD = :qtd WHERE PRODUTO_ID = :id;";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
$stmt->bindParam(":preco", $preco, PDO::PARAM_STR);
$stmt->bindParam(":desconto", $desconto, PDO::PARAM_STR);
$stmt->bindParam(":categoria", $categoria, PDO::PARAM_INT);
$stmt->bindParam(":ativo", $ativo, PDO::PARAM_INT);
$stmt->bindParam(":qtd", $qtd, PDO::PARAM_INT);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);

if($stmt->execute()){
    $_SESSION["msg"] = "Produto alterado com sucesso!";
} else {
    $_SESSION["msg"] = "Erro ao alterar o produto" . $stmt->errorInfo();
}

header("Location: ../../view/produtos.php");
