<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="src/login-cadastro/verificaLogin.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email">

        <label for="senha">Senha</label>
        <input type="password" name="senha">

        <input type="submit" value="entrar">
    </form>
    <p><?php
        if (isset($_SESSION['erroLogin'])) {
            echo $_SESSION['erroLogin'];
            unset($_SESSION['erroLogin']);
        }
        ?></p>
    <a href="cadastro.php">cadastrar</a>
</body>

</html>