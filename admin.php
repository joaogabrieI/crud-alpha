<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Admin</title>
</head>

<body>
    <header>

        <nav>
            <div class="logo">
                <img id="logo" src="assets/img/logo.png" alt="">
                <p>Olá, Seja Bem-vindo!</p>
            </div>
            <p>Administração</p>
        </nav>
    </header>
    <p id="linha"></p>
    <p id="linhaVertical"></p>

    <section class="acoes">
        <ul>
            <li> 
                <a href=""><img src="assets/img/house-icon.png" alt="">Inicio</a>
            </li>
            <li>
                <a href=""><img src="assets/img/database-icon.png" alt="">Produtos</a>
            </li>
            <li>
                <a href=""><img src="assets/img/tags-icon.png" alt="">Categorias</a>
            </li>
            <li>
                <a href=""><img src="assets/img/person-icon.png" alt="">Usuários</a>
            </li>
        </ul>


    </section>

    <section id="usuario">
        <p id="nomeUsuario">Usuário1</p>
        <a href="#"> Sair</a>
    </section>


</body>

</html>