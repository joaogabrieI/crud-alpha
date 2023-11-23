<?php
session_start();
require "../src/conexao-banco.php";

$id = $_GET["id"];

$sql = "SELECT * FROM ADMINISTRADOR WHERE ADM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style/alteraSenha.css" />
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logo.ico">
    <title>Admin</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img id="logo" src="../assets/img/logo.png" alt="" />
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
                <button id="botao-voltar"><a href="usuarios.php">Voltar</a></button>
            </div>
            <?php foreach ($usuarios as $usuario) : ?>
                <form action="../src/usuario/alteraSenha.php?id=<?= $usuario['ADM_ID'] ?>" method="post" id="cadastro">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" required class="input-text">

                    <label for="senha">Confirmar senha</label>
                    <input type="password" name="senha2" required class="input-text">

                    <input type="submit" value="Atualizar" class="botaoCadastro">
                </form>
            <?php endforeach; ?>
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

    <?php foreach ($usuarios as $usuario) : ?>
        <footer>
            <div id="usuario">
                <p id="nomeUsuario">
                    <?= $usuario["ADM_NOME"] ?>
                </p>
                <a href="../src/login-cadastro/logout.php">Sair</a>
            </div>
        </footer>
    <?php endforeach; ?>
</body>

</html>