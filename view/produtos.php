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

$sql2 = "SELECT * FROM PRODUTO p 
    JOIN PRODUTO_IMAGEM pi 
        ON p.PRODUTO_ID = pi.PRODUTO_ID 
    JOIN CATEGORIA c 
        ON p.CATEGORIA_ID = c.CATEGORIA_ID 
    JOIN PRODUTO_ESTOQUE pe
        ON p.PRODUTO_ID = pe.PRODUTO_ID
    WHERE IMAGEM_ORDEM = 1
    ORDER BY p.PRODUTO_ID";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();

$produtos = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style/listaprodutos.css" />
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logo.ico">
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
                <a href="adicionaProdutoForm.php" class="link">
                    <div class="dados">Novo Produto</div>
                </a>
                <form action="" method="post">
                    <input type="search">
                    <input type="submit" value="Buscar">
                </form>
            </div>

        </section>

        <section class="section">

            <table class="dados-produtos">
                <tr class="dados-geral">
                    <th class="nav-produtos">ID</th>
                    <th class="nav-produtos">Imagem</th>
                    <th class="nav-produtos">Nome</th>
                    <th class="nav-produtos" id="preco">Preço</th>
                    <th class="nav-produtos">Desconto%</th>
                    <th class="nav-produtos">QTD</th>
                    <th class="nav-produtos">Categoria</th>
                    <th class="nav-produtos">Ativo</th>
                    <th class="nav-produtos">Ação</th>
                </tr>

                <?php foreach ($produtos as $produto) : ?>
                    <tr class="dados-acoes">
                        <td class="id-valor">
                            <?= $produto['PRODUTO_ID'] ?>
                        </td>
                        <td>
                            <img src="<?= $produto['IMAGEM_URL'] ?>" alt="" class="imgs-jogos">
                        </td>
                        <td class="produto" id="nome-produto">
                            <?= $produto['PRODUTO_NOME'] ?>
                        </td>
                        <td id="preco-valor">
                            <?= $produto['PRODUTO_PRECO'] ?>
                        </td>
                        <td class="desconto">
                            <?= $produto['PRODUTO_DESCONTO'] ?>
                        </td>
                        <td class="qtd">
                            <?= $produto['PRODUTO_QTD'] ?>
                        </td>
                        <td class="categorias-produtos">
                            <?= $produto['CATEGORIA_NOME'] ?>
                        </td>
                        <td class="categorias-produtos">
                            <?= $produto['PRODUTO_ATIVO'] === 1 ? 'Sim' : 'Não' ?>
                        </td>
                        <td class="edit-viw">
                            <a href="editaProdutoForm.php?id=<?= $produto['PRODUTO_ID'] ?>&categoria=<?= $produto['CATEGORIA_ID'] ?>"><img src="../assets/img/editar.png" alt="" class="acoes-img"></a>
                            <a href="ordenaImagensForm.php?id=<?= $produto['PRODUTO_ID'] ?>"><img src="../assets/img/image-fill.svg" alt=""></a>
                            <img src="../assets/img/lixo.png" alt="" class="acoes-img" onclick="confirma()">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

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

    <script>
        function confirma() {
            confirm("Deseja excluir o item?");
        }
    </script>

</body>

</html>