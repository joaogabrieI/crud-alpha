<?php
session_start();

require "../src/conexao-banco.php";

$sql = "SELECT * FROM CATEGORIA";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../src/produto/adicionaProdutos.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome do Produto</label>
        <input type="text" name="nome" id="">
        <label for="descricao">Descrição do Produto</label>
        <input type="text" name="descricao" id="">
        <label for="preco">Preço do Produto</label>
        <input type="number" name="preco" id="">
        <label for="desconto">Desconto a ser aplicado</label>
        <input type="number" name="desconto" id="">
        <label for="categoria">Categoria</label>

        <select name="categoria" id="">
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?= $categoria['CATEGORIA_ID'] ?>"><?= $categoria['CATEGORIA_NOME'] ?></option>
            <?php endforeach; ?>
        </select>
                
        <label for="imagem">Imagem Produto</label>
        <input type="file" name="imagem" id="">

        <input type="submit" value="Cadastrar">
    </form>
    <p><?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?></p>
    </section>

    <p>
        <a href="produtos.php">Voltar</a>
    </p>
</body>

</html>