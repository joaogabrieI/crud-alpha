<?php
session_start();

require "../src/conexao-banco.php";

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../login.php');
    exit();
}

$id = $_SESSION["usuario"];

$sql = "SELECT * FROM ADMINISTRADOR WHERE ADM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_STR);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $sql2 = "SELECT * FROM ADMINISTRADOR WHERE ADM_ID = :id";
// $stmt2->bindParam(":id", $id, PDO::PARAM_STR);
// $stmt2 = $pdo->prepare($sql2);
// $stmt2->execute();

// $dados = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style/user.css" />
    <title>Admin</title>

</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img id="logo" src="../assets/img/logo.png" alt="" />
                <p>Olá, Seja Bem-vindo!</p>
            </div>
            <p>Administração</p>
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
                <div class="dados"><a href="cadastroUsuarioForm.php">Novo Usuário</a></div>
                <div class="dados">Filtrar</div>

            </div>

        </section>

        <section>

            <div class="dados-produtos">

                <table>

                    <tr class="dados-geral">
                        <th class="nav-produtos">ID</th>
                        <th class="nav-produtos">Nome</th>
                        <th class="nav-produtos">Email</th>
                        <th class="nav-produtos">Ativo</th>
                        <th class="nav-produtos" id="acao">Ação</th>
                    </tr>

                    <?php foreach ($usuarios as $usuario): ?>

                        <tr>
                            <td class="id-dados">
                                <?= $usuario['ADM_ID'] ?>
                            </td>

                            <td class="nome-dados">
                                <?= $usuario['ADM_NOME'] ?>
                            </td>

                            <td class="email-dados">
                                <?= $usuario['ADM_EMAIL'] ?>
                            </td>

                            <td class="ativo-dados">
                                <?= $usuario['ADM_ATIVO'] === '1' ? 'Sim' : 'Não' ?>
                            </td>

                            <td class="dados-acoes"><a href="editaUsuarioForm.php?id=<?= $usuario['ADM_ID'] ?>"><img
                                        src="../assets/img/editar.png" alt="" class="acoes-img"></a>

                                <a href="alteraSenhaForm.php?id=<?= $usuario['ADM_ID'] ?>" class="senha-dados">AlterarSenha</a>

                                <form action="../src/usuario/excluiUsuario.php">
                                    <input type="hidden" name="id" value="<?= $dado['ADM_ID'] ?>">
                                    <button type="submit">
                                        <img src="../assets/img/lixo.png" alt="Excluir" class="acoes-img">
                                    </button>
                                </form>
                            </td>

                        </tr>

                    

                </table>

            </div>

            <p>
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            </p>


        </section>
            <section id="usuario">
                <p id="nomeUsuario">
                    <?= $usuario["ADM_NOME"] ?>
                </p>
                <a href="../src/login-cadastro/logout.php">Sair</a>
            </section>
        <?php endforeach; ?>

    </main>

</body>

</html>