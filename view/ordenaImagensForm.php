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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reordenar Imagens</title>
    <link rel="stylesheet" href="../assets/style/ordenaImagens.css">
</head>

<body>

    <form method="post" action="../src/produto/ordenaImagens.php?id=<?= $id ?>">
        <input type="hidden" name="produtoID" value="<?= $id ?>">

        <ol>
            <?php foreach ($imagens as $imagem) : ?>
                <li>
                    <img src="<?= $imagem['IMAGEM_URL'] ?>" class="imagem-produto">
                    <label for="ordem_<?= $imagem['IMAGEM_ID'] ?>">Ordem:</label>
                    <input type="text" name="ordem[<?= $imagem['IMAGEM_ID'] ?>]" value="<?= $imagem['IMAGEM_ORDEM'] ?>" class="input-ordem">
                    <form action="../src/produto/excluiImagem.php" class="form-excluir">
                        <input type="hidden" name="id" value="<?= $imagem['IMAGEM_ID'] ?>">
                        <button type="submit">
                            <img src="../assets/img/lixo.png" alt="Excluir" class="botao-excluir">
                        </button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ol>

        <button type="submit">Salvar Ordem</button>
    </form>

    <a href="produtos.php"><button>Voltar</button></a>
    <a href="adicionaImagens.php?id=<?= $id ?>"><button>Adicionar mais imagens</button></a>

    <p>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
    </p>

</body>

</html>