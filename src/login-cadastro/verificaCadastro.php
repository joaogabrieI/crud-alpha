<?php
session_start();

require '../conexao-banco.php';

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');
$senha = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO administrador (ADM_NOME, ADM_EMAIL, ADM_SENHA) VALUES (:nome, :email, :senha)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);

    $stmt->execute();
    header("location: ../usuario/usuarios.php");
} catch (PDOException $e){
    header("location: ../../cadastro.php");
    $_SESSION['erroCadastro'] = 'erro ao cadastrar usuario ' . $e->getMessage();  
}