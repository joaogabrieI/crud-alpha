<?php
session_start();

require '../conexao-banco.php';

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');
$senha = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO administrador (adm_nome, adm_email, adm_senha) VALUES (:nome, :email, :senha)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);

    $stmt->execute();
    header("location: ../admin/cadastraUsuario.php");
    $_SESSION['msgCadastro'] = 'usuario cadastrado com sucesso';
} catch (PDOException $e){
    header("location: cadastraUsuario.php");
    $_SESSION['msgCadastro'] = 'erro ao cadastrar usuario ' . $e->getMessage();  
}