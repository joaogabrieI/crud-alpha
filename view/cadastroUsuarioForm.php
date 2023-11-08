<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../src/usuario/cadastraUsuario.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="senha">Senha</label>
        <input type="password" name="senha" required>

        <input type="submit" value="Cadastrar">
    </form>
    <p><?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?></p>
    <a href="usuarios.php">Voltar</a>
</body>

</html>