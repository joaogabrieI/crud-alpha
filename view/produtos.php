<?php
session_start();

require "../src/conexao-banco.php";

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$id = $_SESSION["usuario"];

$sql = "SELECT ADM_NOME FROM administrador WHERE ADM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_STR);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM PRODUTO p 
    JOIN PRODUTO_IMAGEM pi 
        ON p.PRODUTO_ID = pi.PRODUTO_ID 
    JOIN CATEGORIA c 
        ON p.CATEGORIA_ID = c.CATEGORIA_ID";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();

$produtos = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Admin</title>
</head>

<body>
    <header>

        <nav>
            <div class="logo">
                <img id="logo" src="../assets/img/logo.png" alt="">
                <p>Olá, Seja Bem-vindo!</p>
            </div>
            <p>Produtos</p>
        </nav>
    </header>
    <p id="linha"></p>
    <p id="linhaVertical"></p>

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
        <div>
            <a href="adicionaProdutoForm.php">Cadastrar novo produto</a>
        </div>
    </section>

    <section>
        <table>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Desconto</th>
                <th>Categoria</th>
                <th>Ativo</th>
                <th>Imagem</th>
            </tr>
            <?php foreach ($produtos as $produto) : ?>
                <tr>
                    <td><?= $produto['PRODUTO_ID'] ?></td>
                    <td><?= $produto['PRODUTO_NOME'] ?></td>
                    <td><?= $produto['PRODUTO_DESC'] ?></td>
                    <td><?= $produto['PRODUTO_PRECO'] ?></td>
                    <td><?= $produto['PRODUTO_DESCONTO']?></td>
                    <td><?= $produto['CATEGORIA_NOME']?></td>
                    <td><?= $produto['PRODUTO_ATIVO']?></td>    
                    <td><img src="<?= $produto['IMAGEM_URL']?>" alt="" height="50px" weight="50px"></td>             
                </tr>
        </table>
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