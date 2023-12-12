<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha</title>
    <link rel="stylesheet" href="../assets/style/login.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logo.ico">
</head>

<body>
    <div class="container" id="container">

        <div class="form-container register-container">
            <form action="../src/login-cadastro/verificaCadastro.php" method="post">
                <img src="../assets/img/icon-logo2.png" alt="" class="logo">
                <h1>Registre - se</h1>
                <input type="text" placeholder="Name" class="registrar-login" name="nome" required>
                <input type="email" placeholder="Email" class="registrar-login" name="email" required>
                <input type="password" placeholder="Password" class="registrar-login" name="senha" required>
                <input type="submit" value="Registrar" class="login-btn">
            </form>


</div>
            <p class='teste'><?php
                    if (isset($_SESSION['erroLogin'])) {
                        echo $_SESSION['erroLogin'];
                        unset($_SESSION['erroLogin']);
                    }
            ?>
            </p>

        <div class="form-container login-container">
            <form action="../src/login-cadastro/verificaLogin.php" method="post">
                <img src="../assets/img/icon-logo2.png" alt="" class="logo">
                <h1>Login</h1>
                <input type="email" placeholder="Email" id="email" class="login-email-senha" name="email" required>
                <input type="password" placeholder="Password" id="senha" class="login-email-senha" name="senha" required>
                <input type="submit" value="Login" class="login-btn">
            </form>
            <p><?php
                if (isset($_SESSION['erroCadastro'])) {
                    echo $_SESSION['erroCadastro'];
                    unset($_SESSION['erroCadastro']);
                }
                ?></p>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Seja Bem-Vindo</h1>
                    <p>se já possuí uma conta, faça o login aqui</p>
                    <button class="ghost" id="login">Login
                        <i class="lni lni-arrow-left login"></i>
                    </button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="title">Comece sua jornada agora</h1>
                </div>
            </div>
        </div>

    </div>

    <script src="../assets/login.js"></script>
</body>

</html>