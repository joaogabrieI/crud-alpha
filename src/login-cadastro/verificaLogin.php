<?php
session_start();

require_once "../conexao-banco.php";

$emailDigitado = filter_input(INPUT_POST, 'email');
$senhaDigitada = filter_input(INPUT_POST, 'senha');

$sql = "SELECT COUNT(*) FROM ADMINISTRADOR WHERE ADM_EMAIL = :emailDigitado";
$stmt = $pdo->prepare($sql);
$_SESSION['erroLogin'] = '';

$sql2 = "SELECT ADM_SENHA, ADM_ID FROM ADMINISTRADOR WHERE ADM_EMAIL = :emailDigitado";
$stmt2 = $pdo->prepare($sql2);

try {
    $stmt->bindParam(':emailDigitado', $emailDigitado, PDO::PARAM_STR);
    $stmt2->bindParam(':emailDigitado', $emailDigitado, PDO::PARAM_STR);
    $stmt->execute();
    $stmt2->execute();

    $dados = $stmt2->fetchAll();

    foreach ($dados as $dado) {
        $senha = $dado;
    }

    $senhaDoBanco = password_verify($senhaDigitada, $senha['ADM_SENHA']);
    $resultado = $stmt->fetchColumn();
    if ($resultado > 0) {
        if ($senhaDoBanco) {
            $_SESSION["usuario"] = $senha["ADM_ID"];
            header("location: ../../view/admin.php");
        } else {
            $_SESSION['erroLogin'] = 'senha incorreta';
            header("location: ../../view/login.php");
        }
    } else {
        $_SESSION['erroLogin'] = 'email não cadastrado!';
        header("location: ../../view/login.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
