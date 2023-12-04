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
    WHERE pi.IMAGEM_ORDEM = 1
    ORDER BY p.PRODUTO_ID";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();

$busca = filter_input(INPUT_POST, 'busca');

if (!empty($busca)) {
    $busca = '%' . $busca . '%';
    $sqlBusca = "SELECT * FROM PRODUTO p 
    JOIN PRODUTO_IMAGEM pi 
        ON p.PRODUTO_ID = pi.PRODUTO_ID 
    JOIN CATEGORIA c 
        ON p.CATEGORIA_ID = c.CATEGORIA_ID 
    JOIN PRODUTO_ESTOQUE pe
        ON p.PRODUTO_ID = pe.PRODUTO_ID
    WHERE pi.IMAGEM_ORDEM = 1 AND p.PRODUTO_NOME LIKE :busca
    ORDER BY p.PRODUTO_ID";
    $stmt = $pdo->prepare($sqlBusca);
    $stmt->bindParam(':busca', $busca, PDO::PARAM_STR);
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $produtos = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}

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
                <img id="logo" src="../assets/img/icon-logo2.png" alt="" />
            </div>
            <p>Produtos</p>
        </nav>
    </header>

    <main>
        <section class="side-bar">
            <div id="acoes">
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
            </div>


            <?php foreach ($usuarios as $usuario) : ?>
                <div id="usuario">
                    <p id="nomeUsuario">
                        <?= $usuario["ADM_NOME"] ?>
                    </p>
                    <a href="../src/login-cadastro/logout.php">Sair</a>
                </div>
            <?php endforeach; ?>
        </section>

        <section id="produtos">

            <div id="container-top-table">
                <div class="nav-adm-produto">
                    <img src="../assets/img/icone.png" alt="" class="icon-m">
                    <a href="adicionaProdutoForm.php" class="link">
                        <div class="dados">Novo Produto</div>
                    </a>
                    <form method="post">
                        <input type="text" name="busca" id="produto" onkeyup="buscarProdutos()" placeholder="Buscar" class="buscar-dados">
                    </form>
                    <a href="produtos.php" class="link">
                        <div class="dados">Todos os Produtos</div>
                    </a>
                </div>
            </div>

            <div id="tabela-produtos">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Desconto%</th>
                            <th>QTD</th>
                            <th>Categoria</th>
                            <th>Ativo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($produtos as $produto) : ?>
                            <tr>
                                <td>
                                    <?= $produto['PRODUTO_ID'] ?>
                                </td>
                                <td>
                                    <img src="<?= $produto['IMAGEM_URL'] ?>" alt="">
                                </td>
                                <td>
                                    <?= $produto['PRODUTO_NOME'] ?>
                                </td>
                                <td>
                                    <?= $produto['PRODUTO_PRECO'] ?>
                                </td>
                                <td>
                                    <?= $produto['PRODUTO_DESCONTO'] ?>
                                </td>
                                <td>
                                    <?= $produto['PRODUTO_QTD'] ?>
                                </td>
                                <td>
                                    <?= $produto['CATEGORIA_NOME'] ?>
                                </td>
                                <td>
                                    <?= $produto['PRODUTO_ATIVO'] === 1 ? 'Sim' : 'Não' ?>
                                </td>
                                <td id="container-editar">
                                    <div class="editar">
                                        <a href="editaProdutoForm.php?id=<?= $produto['PRODUTO_ID'] ?>&categoria=<?= $produto['CATEGORIA_ID'] ?>"><img src="../assets/img/editar.png" alt="" class="edit-img"></a>
                                        <a href="ordenaImagensForm.php?id=<?= $produto['PRODUTO_ID'] ?>"><img src="../assets/img/image-fill.svg" alt="" class="edit-img"></a>
                                        <form action="../src/produto/excluiProduto.php">
                                            <input type="hidden" name="id" value="<?= $produto['PRODUTO_ID'] ?>">
                                            <button class="btn-l" type="submit" onclick="return confirm('Deseja mesmo excluir esse produto?'); return false;">
                                                <img src="../assets/img/lixo.png" alt="Excluir" class="edit-img">
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function buscarProdutos() {
            var termoBusca = $("#produto").val();

            $.ajax({
                type: "POST",
                url: "produtos.php", // Nome do script PHP que processa a busca
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