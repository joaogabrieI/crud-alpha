<?php
session_start();

require "../src/conexao-banco.php";

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../login.php');
    exit();
}

$id = $_SESSION["usuario"];

$sql = "SELECT ADM_NOME FROM ADMINISTRADOR WHERE ADM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_STR);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM ADMINISTRADOR";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();

$dados = $stmt2->fetchAll(PDO::FETCH_ASSOC);


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

        <section class="dados-produtos">

            <div>
                <nav>
                    <ul class="nav-produtos-dados">
                        <li class="nav-produtos">ID</li>
                        <li class="nav-produtos">Nome</li>
                        <li class="nav-produtos">Email</li>
                        <li class="nav-produtos">Ativo</li>
                        <li class="nav-produtos" id="acao">Ação</li>
                    </ul>
                </nav>
                <?php foreach ($dados as $dado) : ?>
                    <div class="dados-acoes">
                        <p><?= $dado['ADM_ID'] ?></p>
                        <p class="produto"><?= $dado['ADM_NOME'] ?></p>
                        <p><?= $dado['ADM_EMAIL'] ?></p>
                        <p><?= $dado['ADM_ATIVO'] === 1 ? 'Sim' : 'Não' ?></p>
                        <div class="acoes-edv">
                            <a href="editaUsuarioForm.php?id=<?= $dado['ADM_ID'] ?>"><img src="../assets/img/editar.png" alt="" class="acoes-img"></a>
                            <a href="alteraSenhaForm.php?id=<?= $dado['ADM_ID'] ?>">Alterar Senha</a>
                            <form action="../src/usuario/excluiUsuario.php">
                                <input type="hidden" name="id" value="<?= $dado['ADM_ID'] ?>">
                                <button type="submit">
                                    <img src="../assets/img/lixo.png" alt="Excluir" class="acoes-img">
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
                <p><?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    ?></p>
        </section>

        <?php foreach ($usuarios as $usuario) : ?>
            <section id="usuario">
                <p id="nomeUsuario"><?= $usuario["ADM_NOME"] ?></p>
                <a href="../src/login-cadastro/logout.php">Sair</a>
            </section>
        <?php endforeach; ?>


</body>

</html>