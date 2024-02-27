<?php
session_start();

require "../vendor/autoload.php";

use Alpha\Domain\Infrastructure\Repository\PdoUserRepository;
use Alpha\Domain\Model\User;

$id = User::loggedIn();

$repo = new PdoUserRepository();
$users = $repo->listAll();


$userLogged = $repo->findById($id);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style/user.css" />
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logo.ico">
    <title>Alpha</title>

</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img id="logo" src="../assets/img/icon-logo2.png" alt="" />
            </div>
            <p>Usuários</p>
        </nav>
    </header>

    <p id="linha"></p>
    <p id="linhaVertical"></p>

    <main>

        <section class="acoes">
            <ul>
                <li>
                    <a href="admin.php"><img src="../assets/img/house-icon.png" alt="">Inicio</a>
                </li>
                <li>
                    <a href="produtos.php"><img src="../assets/img/database-icon.png" alt="">Produtos</a>
                </li>
                <li>
                    <a href="categorias.php"><img src="../assets/img/tags-icon.png" alt="">Categorias</a>
                </li>
                <li>
                    <a href="usuarios.php"><img src="../assets/img/person-icon.png" alt="">Usuários</a>
                </li>
            </ul>
        </section>

        <section>

            <div class="nav-adm-produto">
                <img src="../assets/img/icone.png" alt="" class="icon-m">
                <a href="cadastroUsuarioForm.php">
                    <div class="dados">Novo Usuário</div>
                </a>
            </div>

        </section>

        <section>

            <div class="dados-produtos">

                <table class="tbl-pai">
                    <thead>
                    <tr class="dados-geral">
                        <th class="nav-produtos">ID</th>
                        <th class="nav-produtos">Nome</th>
                        <th class="nav-produtos">Email</th>
                        <th class="nav-produtos">Ativo</th>
                        <th class="nav-produtos" id="acao">Ação</th>
                    </tr>
                    </thead>

                    <tbody>
                        <tr class="teste">
                            <td class="id-dados">
                                <?= $userLogged->getId(); ?>
                            </td>

                            <td class="nome-dados">
                                <?= $userLogged->getName(); ?>
                            </td>

                            <td class="email-dados">
                                <?= $userLogged->getEmail(); ?>
                            </td>

                            <td class="ativo-dados">
                                <?= $userLogged->getActive() === 1 ? 'Sim' : 'Não' ?>
                            </td>

                            <td class="dados-acoes"><a href="editaUsuarioForm.php?id=<?= $userLogged->getId(); ?>"><img src="../assets/img/editar.png" alt="" class="acoes-img"></a>

                                <a href="alteraSenhaForm.php?id=<?= $userLogged->getId(); ?>" class="senha-dados"><img src="../assets/img/key.svg" alt="" class="chave"></a>


                                <form action="../src/usuario/excluiUsuario.php">
                                    <input type="hidden" name="id" value="<?= $userLogged->getId(); ?>">
                                    <button class="btn-l" type="submit" onclick="return confirm('Deseja mesmo excluir esse usuário?'); return false;">
                                        <img src="../assets/img/lixo.png" alt="Excluir" class="acoes-img">
                                    </button>
                                </form>
                            </td>

                        </tr>

                    <?php foreach ($users as $user) : ?>

                        <tr class="teste">
                            <td class="id-dados">
                                <?= $user->getId(); ?>
                            </td>

                            <td class="nome-dados">
                                <?= $user->getName(); ?>
                            </td>

                            <td class="email-dados">
                                <?= $user->getEmail(); ?>
                            </td>

                            <td class="ativo-dados">
                                <?= $user->getActive() === 1 ? 'Sim' : 'Não' ?>
                            </td>

                            <td class="dados-acoes">
                                <a href="usuarios.php" onclick="alert('Você não tem permissão para editar esse usuário!')"><img src="../assets/img/editar.png" alt="" class="acoes-img"></a>
                                <a href="usuarios.php" class="senha-dados" onclick="alert('Você não tem permissão para editar esse usuário!')"><img src="../assets/img/key.svg" alt="" class="chave"></a>
                                <form action="../src/usuario/excluiUsuario.php" method="post" id="aviso">
                                    <input type="hidden" name="id" value="<?= $user->getId() ?>">
                                    <button class="btn-l" type="submit">
                                        <img src="../assets/img/lixo.png" alt="Excluir" class="acoes-img">
                                    </button>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div id="error-msg">
                <p>
                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    ?>
                </p>
            </div>

        </section>

        <section id="usuario">
            <p id="nomeUsuario">
                <?= $userLogged->getName(); ?>
            </p>
            <a href="../src/login-cadastro/logout.php">Sair</a>
        </section>


    </main>

    <script>
        document.getElementById('aviso').addEventListener('submit', function(event) {
            alert('Você não tem permissão para isso!');
            event.preventDefault();
        });
    </script>

</body>

</html>