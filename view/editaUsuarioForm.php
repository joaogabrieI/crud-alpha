<?php

session_start();

require "../vendor/autoload.php";

use Alpha\Domain\Infrastructure\Repository\PdoUserRepository;
use Alpha\Domain\Model\User;

$id = User::loggedIn();

$repo = new PdoUserRepository();

$userLogged = $repo->findById($id);
$user = $repo->findById(filter_input(INPUT_GET,$_GET['id']));

if (isset($_POST['cadastro'])) {
    $newUser = new User(
            $user->getId(),
            filter_input(INPUT_POST, $_POST['nome']),
            filter_input(INPUT_POST, $_POST['email']),
            $user->getPassword(),
            filter_input(INPUT_POST, $_POST['ativo'])
        );

        $repo->update($newUser);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style/editaUsuario.css" />
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logo.ico">
    <title>Alpha</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img id="logo" src="../assets/img/icon-logo2.png" alt="" />
            </div>
            <p>Edição de Usuário</p>
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
                <label for="nome">Nome</label>
                <input type="text" name="nome" required value="<?= $user->getName() ?>" class="input-text">

                <label for="email">Email</label>
                <input type="email" name="email" value="<?= $user->getEmail() ?>" required class="input-text">

                <p>Ativo</p>
                <div class="radio">
                    <label for="ativoSim">Sim</label>
                    <input type="radio" name="ativo" value="1" <?= $user->getActive() === 1 ? 'checked' : '' ?>>

                    <label for="ativoNão">Não</label>
                    <input type="radio" name="ativo" value="0" <?= $user->getActive() === 0 ? 'checked' : '' ?>>
                </div>

                <input type="submit" value="Atualizar" name="cadastro" class="botaoCadastro" onclick="return confirm('Deseja mesmo alterar o usuário?'); return false;">
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