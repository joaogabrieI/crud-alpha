<?php
session_start();

require "../vendor/autoload.php";

use Alpha\Domain\Infrastructure\Repository\PdoUserRepository;
use Alpha\Domain\Model\User;

$id = User::loggedIn();

$repo = new PdoUserRepository();
$users = $repo->listAll();


$userLogged = $repo->findById($id);
$user = $repo->findById($_GET['id']);

if (isset($_POST['cadastro'])) {
    $newUser = new User(
            $user->getId(),
            $user->getName(),
            $user->getEmail(),
            $_POST['senha'],
            $user->getActive()
        );

        $repo->changePassword($newUser, $_POST['senha2']);
        
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style/alteraSenha.css" />
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logo.ico">
    <title>Alpha</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img id="logo" src="../assets/img/icon-logo2.png" alt="" />
            </div>
            <p>Alterar Senha</p>
        </nav>
    </header>
    <p id="linha"></p>
    <p id="linhaVertical"></p>

    <main>
        <section class="acoes">
            <ul>
                <li>
                    <a href="admin.php"><img src="../assets/img/house-icon.png" alt="" />Inicio</a>
                </li>
                <li>
                    <a href="produtos.php"><img src="../assets/img/database-icon.png" alt="" />Produtos</a>
                </li>
                <li>
                    <a href="categorias.php"><img src="../assets/img/tags-icon.png" alt="" />Categorias</a>
                </li>
                <li>
                    <a href="usuarios.php"><img src="../assets/img/person-icon.png" alt="" />Usuários</a>
                </li>
            </ul>
        </section>

        <section id="containerCadastro">
            <div id="voltarParaLista">
                <img src="../assets/img/voltar.png" alt="">
                <a href="usuarios.php"><button id="botao-voltar">Voltar</button></a>
            </div>
                <form method="post" id="cadastro">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" required class="input-text">

                    <label for="senha">Confirmar senha</label>
                    <input type="password" name="senha2" required class="input-text">

                    <input type="submit" value="Atualizar" class="botaoCadastro" name="cadastro">
                </form>
            <div>
                <p id="error-msg"><?php
                                    if (isset($_SESSION['msg'])) {
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);
                                    }
                                    ?></p>
            </div>
        </section>


    </main>
        <footer>
            <div id="usuario">
                <p id="nomeUsuario">
                    <?= $userLogged->getName() ?>
                </p>
                <a href="../src/login-cadastro/logout.php">Sair</a>
            </div>
        </footer>
    
</body>

</html>