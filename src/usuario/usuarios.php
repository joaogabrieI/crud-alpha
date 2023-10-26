<?php
session_start();

require "../conexao-banco.php";

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../login.php');
    exit();
}

$id = $_SESSION["usuario"];

$sql = "SELECT ADM_NOME FROM administrador WHERE ADM_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_STR);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM administrador";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();

$dados = $stmt2->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/style.css">
    <title>Admin</title>
</head>

<body>
    <header>

        <nav>
            <div class="logo">
                <img id="logo" src="../../assets/img/logo.png" alt="">
                <p>Olá, Seja Bem-vindo!</p>
            </div>
            <p>Usuários</p>
        </nav>
    </header>
    <p id="linha"></p>
    <p id="linhaVertical"></p>

    <section class="acoes">
        <ul>
            <li>
                <a href=""><img src="../../assets/img/house-icon.png" alt="">Inicio</a>
            </li>
            <li>
                <a href=""><img src="../../assets/img/database-icon.png" alt="">Produtos</a>
            </li>
            <li>
                <a href=""><img src="../../assets/img/tags-icon.png" alt="">Categorias</a>
            </li>
            <li>
                <a href="usuarios.php"><img src="../../assets/img/person-icon.png" alt="">Usuários</a>
            </li>
        </ul>
    </section>

    <section>
        <div>
            <a href="cadastroUsuarioForm.php">Cadastrar novo usuário</a>
        </div>
        <table>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($dados as $dado) : ?>
                <tr>
                    <td><?= $dado['ADM_ID'] ?></td>
                    <td><?= $dado['ADM_NOME'] ?></td>
                    <td><?= $dado['ADM_EMAIL'] ?></td>
                    <td><?= $dado['ADM_ATIVO'] === null ? 'Sim' : 'Não' ?></td>
                    <td>
                        <a href="editaUsuarioForm.php?id=<?= $dado['ADM_ID'] ?>">Editar</a>
                        <a href="alteraSenhaForm.php?id=<?= $dado['ADM_ID'] ?>">Alterar Senha</a>
                    </td>
                    <td>
                        <form action="excluiUsuario.php">
                            <input type="hidden" name="id" value="<?= $dado['ADM_ID'] ?>">
                            <input type="submit" value="Excluir"></input>
                        </form>
                    </td>
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
            <a href="logout.php">Sair</a>
        </section>
    <?php endforeach; ?>


</body>

</html>