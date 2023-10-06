<?php

require '../conexao-banco.php';

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');

try {
    $sql = "INSERT INTO admin (nome, email, senha) VALUES (:nome, :email, :senha)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);

    $stmt->execute();
    header("location: admin.php");
} catch (PDOException $e){
    echo 'erro ao inserir os dados' . $e->getMessage();
}