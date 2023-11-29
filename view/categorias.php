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

$sql2 = "SELECT * FROM CATEGORIA";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();

$busca = filter_input(INPUT_POST, 'busca');

if (!empty($busca)) {
    $busca = '%' . $busca . '%';
    $sqlBusca = "SELECT * FROM CATEGORIA WHERE CATEGORIA_NOME LIKE :busca";
    $stmtBusca = $pdo->prepare($sqlBusca);
    $stmtBusca->bindParam(':busca', $busca, PDO::PARAM_STR);
    $stmtBusca->execute();
    $dados = $stmtBusca->fetchAll(PDO::FETCH_ASSOC);
} else {
    $dados = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style/categoria.css" />
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logo.ico">
    <title>Admin</title>

</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img id="logo" src="../assets/img/logo.png" alt="" />
            </div>
            <p>Categorias</p>
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
                <img src="../assets/img/icone.png" alt="" class="icon-m">
                <div class="dados"><a href="adicionaCategoriaForm.php">Nova Categoria</a></div>
                <form method="post">
                    <label for="busca">Buscar</label>
                    <input type="text" name="busca" id="categoria" onkeyup="buscarCategorias()">
                </form>
                <a href="categorias.php" class="link">
                    <div class="dados">Todos os Produtos</div>
                </a>
            </div>

        </section>

        <section>
            <table class="dados-produtos">

                <tr class="nav-produtos-dados">
                    <th class="nav-produtos">ID</th>
                    <th class="nav-produtos">Categoria</th>
                    <th class="nav-produtos">Descrição</th>
                    <th class="nav-produtos">Ativo</th>
                    <th class="nav-produtos">Ação</th>
                </tr>

                <?php foreach ($dados as $dado) : ?>

                    <tr class="dados-acoes">
                        <td>
                            <?= $dado['CATEGORIA_ID'] ?>
                        </td>

                        <td class="descrever">
                            <?= $dado['CATEGORIA_NOME'] ?>
                        </td>

                        <td class="descrever">
                            <?= $dado['CATEGORIA_DESC'] ?>
                        </td>

                        <td>
                            <?= $dado['CATEGORIA_ATIVO'] === 1 ? 'Sim' : 'Não' ?>
                        </td>

                        <td class="icones">
                            <a href="editaCategoriaForm.php?id=<?= $dado['CATEGORIA_ID'] ?>"><img src="../assets/img/editar.png" alt="" class="acoes-img"></a>
                            <form action="../src/categoria/excluiCategoria.php">
                                <input type="hidden" name="id" value="<?= $dado['CATEGORIA_ID'] ?>">
                                <button type="submit" class="submit-customizado">
                                    <img src="../assets/img/lixo.png" alt="" class="acoes-img" onclick="return confirm('Deseja mesmo excluir essa categoria?'); return false;">
                                </button>
                            </form>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </table>

            <p><?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?></p>


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


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
            function buscarCategorias() {
                var termoBusca = $("#categoria").val();

                $.ajax({
                    type: "POST",
                    url: "categorias.php", // Nome do script PHP que processa a busca
                    data: {
                        produto: termoBusca
                    },
                    success: function(response) {
                        $("#dados-produtos").html(response);
                    }
                });
            }
    </script>

</body>

</html>