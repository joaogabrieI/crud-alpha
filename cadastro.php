<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="src/login-cadastro/verificaCadastro.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="senha">Senha</label>
        <input type="password" name="senha" required>

        <input type="submit" value="Cadastrar">
    </form>
    <p><?php
        if (isset($_SESSION['erroCadastro'])) {
            echo $_SESSION['erroCadastro'];
            unset($_SESSION['erroCadastro']);
        }
        ?></p>
    <a href="login.php">Login</a>
</body>

</html>