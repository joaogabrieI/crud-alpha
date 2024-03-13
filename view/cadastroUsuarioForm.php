<?php
session_start();

require "../vendor/autoload.php";

use Alpha\Domain\Infrastructure\Repository\PdoUserRepository;
use Alpha\Domain\Model\User;

$id = User::loggedIn();

$repo = new PdoUserRepository();
$userLogged = $repo->findById($id);

if (isset($_POST['cadastro'])) {
    $user = new User(
        null,
        filter_input(INPUT_POST, $_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS),
        filter_input(INPUT_POST, $_POST['email'], FILTER_SANITIZE_EMAIL),
        filter_input(INPUT_POST, $_POST['senha']),
        1
    );
    if ($repo->save($user)) {
        header("Location: usuarios.php");
        $_SESSION['msg'] = 'Usuário cadastrado com sucesso!';
    } else {
        header("Location: cadastroUsuarioForm.php");
        $_SESSION['msg'] = 'Erro ao cadastrar usuario: ' . $stmt->errorInfo();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style/cadastroUsuario.css" />
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logo.ico">
    <title>Alpha</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img id="logo" src="../assets/img/icon-logo2.png" alt="" />
            </div>
            <p>Cadastro de usuários</p>
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
                <input type="text" name="nome" required class="input-text">

                <label for="email">Email</label>
                <input type="email" name="email" required class="input-text">

                <label for="senha">Senha</label>
                <input type="password" name="senha" required class="input-text">

                <input type="submit" value="Cadastrar" class="botaoCadastro" name="cadastro">
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
                <?= $userLogged->getName(); ?>
            </p>
            <a href="../src/login-cadastro/logout.php">Sair</a>
        </div>
    </footer>
</body>

</html>