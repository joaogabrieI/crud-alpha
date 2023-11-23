<?php session_start();
require "../src/conexao-banco.php";

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../login.php');
    exit();
}

$id = $_SESSION["usuario"];

$sql2 = "SELECT * FROM ADMINISTRADOR WHERE ADM_ID = :id";
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindParam(":id", $id, PDO::PARAM_STR);
$stmt2->execute();

$usuarios = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style/editaUsuario.css" />
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logo.ico">
    <title>Admin</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img id="logo" src="../assets/img/logo.png" alt="" />
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
                <button id="botao-voltar"><a href="usuarios.php">Voltar</a></button>
            </div>
            <?php foreach ($usuarios as $usuario) : ?>
                <form action="../src/usuario/editaUsuario.php?id=<?= $usuario['ADM_ID'] ?>" method="post" id="cadastro">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" required value="<?= $usuario['ADM_NOME'] ?>" class="input-text">

                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?= $usuario['ADM_EMAIL'] ?>" required class="input-text">

                    <p>Ativo</p>
                    <div class="radio"> 
                        <label for="ativoSim">Sim</label>
                        <input type="radio" name="ativo" value="1" <?= $usuario['ADM_ATIVO'] === '1' ? 'checked' : '' ?>>

                        <label for="ativoNão">Não</label>
                        <input type="radio" name="ativo" value="0" <?= $usuario['ADM_ATIVO'] === '0' ? 'checked' : '' ?>>
                    </div>

                    <input type="submit" value="Atualizar" class="botaoCadastro" onclick="return confirm('Deseja mesmo alterar o usuário?'); return false;">
                </form>
            <?php endforeach ?>
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