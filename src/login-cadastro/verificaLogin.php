<?php
session_start();

require_once "../conexao-banco.php";

$emailDigitado = filter_input(INPUT_POST, 'email');
$senhaDigitada = filter_input(INPUT_POST, 'senha');
$sql = "SELECT COUNT(*) FROM admin WHERE email = :emailDigitado";
$stmt = $pdo->prepare($sql);
$_SESSION['erroLogin'] = '';

try {
    $stmt->bindParam(':emailDigitado', $emailDigitado, PDO::PARAM_STR);
    $stmt->execute();

    $resultado = $stmt->fetchColumn();
    if ($resultado > 0) {
        header("location: ../admin/admin.php");
    } else {
        $_SESSION['erroLogin'] = 'email ja cadastrado!';
        header("location: ../../login.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
