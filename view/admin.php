<?php
session_start();

require "../src/conexao-banco.php";

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$id = $_SESSION["usuario"];

$sql = "SELECT ADM_NOME FROM ADMINISTRADOR WHERE ADM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_STR);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style/adm.css" />
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logo.ico">
    <title>Admin</title>

</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img id="logo" src="../assets/img/icon-logo2.png" alt="" />
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

        <section>

            <div class="nav-adm-produto">
                <div class="dados">Olá, seja Bem-vindo</div>
                <img src="../assets/img/salve2.png" alt="" class="icon-m">
                
            </div>

        </section>

        <section class="section-nav-home">

            <div class="nav-home">
                <a href="adicionaProdutoForm.php"><p class="n-prod"> <img src="../assets/img/database-icon.png" alt="" /> Adicionar novo Produto</p></a>
                <a href="adicionaCategoriaForm.php"><p class="n-cate"><img src="../assets/img/tags-icon.png" alt=""/> Adicionar nova Categoria</p></a>

            </div>

            <div class="nav-home">
                <a href="cadastroUsuarioForm.php"><p class="n-user"><img src="../assets/img/person-icon.png" alt=""/> Adicionar novo Usuário</p></a>
                <a href="../src/login-cadastro/logout.php"><p class="n-sair"><img src="../assets/img/sair.png" alt="" class="sair"/> Sair</p></a>
            </div>

        </section>



    </main>

    <?php foreach ($usuarios as $usuario) : ?>
        <footer>
            <div id="usuario">
                <p id="nomeUsuario"><?=$usuario['ADM_NOME']?></p>
                <a href="../src/login-cadastro/logout.php">Sair</a>
            </div>
        </footer>
    <?php endforeach; ?>


</body>

</html>