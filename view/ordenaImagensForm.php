<?php
session_start();

require "../src/conexao-banco.php";

$id = $_GET['id'];

$sql = "SELECT * FROM PRODUTO_IMAGEM WHERE PRODUTO_ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$imagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reordenar Imagens</title>
    <link rel="stylesheet" href="../assets/style/ordenaImagens.css">
    <link rel="shortcut icon" type="imagex/png" href="../assets/img/logo.ico">
</head>

<body>
    <main>
        <section id="ordenar-imagem">
            <div class="content">
                <form method="post" action="../src/produto/ordenaImagens.php?id=<?= $id ?>">
                    <input type="hidden" name="produtoID" value="<?= $id ?>">

                    <ol>
                        <?php foreach ($imagens as $imagem): ?>
                            <li>
                                <img src="<?= $imagem['IMAGEM_URL'] ?>" class="imagem-produto">
                                <label for="ordem_<?= $imagem['IMAGEM_ID'] ?>">Ordem:</label>
                                <input type="text" name="ordem[<?= $imagem['IMAGEM_ID'] ?>]"
                                    value="<?= $imagem['IMAGEM_ORDEM'] ?>" class="input-ordem">
                                <a class="botao-excluir"
                                    href="../src/produto/excluiImagem.php?id=<?= $imagem['IMAGEM_ID'] ?>&produto=<?= $imagem['PRODUTO_ID'] ?>"
                                    onclick="return confirm('Deseja mesmo excluir essa imagem?'); return false;">
                                    <img src="../assets/img/lixo.png" alt="Excluir">
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ol>

                    <button type="submit" class="salvar-ordem">Salvar Ordem</button>
                </form>

                <div id="botoes">
                    <a href="produtos.php"><button class="salvar-ordem">Voltar</button></a>
                    <a href="adicionaImagens.php?id=<?= $id ?>"><button class="salvar-ordem">Adicionar mais
                            imagens</button></a>
                </div>

                <div>
                    <p>
                        <?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?>
                    </p>
                </div>
            </div>
        </section>

        <section>

        </section>

        <section class="error-msg">

        </section>
    </main>
</body>

</html>