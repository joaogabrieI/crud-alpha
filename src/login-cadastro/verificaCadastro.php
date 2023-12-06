<?php
session_start();

require '../conexao-banco.php';

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');
$senha = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO ADMINISTRADOR (ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO) VALUES (:nome, :email, :senha, 1)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);

    $stmt->execute();
    $_SESSION["usuario"] = $pdo->lastInsertId();
    header("location: ../../view/login.php");
    $_SESSION['erroLogin'] = 'Usuário cadastrado com sucesso!'; 
} catch (PDOException $e){
    header("location: ../../view/login.php");
    $_SESSION['erroCadastro'] = 'Erro ao cadastrar usuario!' . $e->getMessage();  
}