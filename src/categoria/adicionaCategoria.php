<?php

session_start();

require "../conexao-banco.php";

$nome = filter_input(INPUT_POST, 'nomeCategoria');
$descricao = filter_input(INPUT_POST, 'descricao');

$sql = "INSERT INTO categoria (CATEGORIA_NOME, CATEGORIA_DESC) VALUES (:nome, :descricao)";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);

if ($stmt->execute()) {
    $_SESSION['msg'] = 'Categoria adicionada com sucesso!';
    header("location: ../../view/adicionaCategoriaForm.php");
} else {
    $_SESSION['msg'] = 'Erro ao adicionar categoria: ' . $stmt->errorInfo();
    header("location: ../../view/adicionaCategoriaForm.php");
}
