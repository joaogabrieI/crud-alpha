<?php

session_start();

require "../conexao-banco.php";

$nome = filter_input(INPUT_POST, "nome", FILTER_DEFAULT);
$descricao = filter_input(INPUT_POST, "descricao", FILTER_DEFAULT);
$preco = floatval(filter_input(INPUT_POST, "preco", FILTER_DEFAULT));
$desconto = floatval(filter_input(INPUT_POST, "desconto", FILTER_DEFAULT));
$categoria = filter_input(INPUT_POST, "categoria", FILTER_DEFAULT);


$sql = "INSERT INTO produto (PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, CATEGORIA_ID, PRODUTO_ATIVO) VALUES (:nome, :descricao, :preco, :desconto, :categoria, 1)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
$stmt->bindParam(":preco", $preco, PDO::PARAM_INT);
$stmt->bindParam(":desconto", $desconto, PDO::PARAM_INT);
$stmt->bindParam(":categoria", $categoria, PDO::PARAM_INT);

if ($stmt->execute()) {
    $_SESSION['msg'] = 'Produto adicionado com sucesso!';
    header("location: adicionaProdutoForm.php");
} else {
    $_SESSION['msg'] = 'Erro ao adicionar produto: ' . $stmt->errorInfo();
    header("location: adicionaProdutoForm.php");
}



