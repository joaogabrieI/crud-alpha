<?php
session_start();

$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Imagens</title>
    <link rel="stylesheet" href="../assets/style/adicionaImagens.css">
</head>

<body>
    <main>
        <section id="add-imagem">
            <div class="content">
                <form action="../src/produto/addImagens.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
                    <label for="imagem">Adicionar Novas Imagens:</label>
                    <input type="file" name="imagem[]" multiple accept="image/*" required>
                    <input type="submit" value="Adicionar Imagens" id="submit-add-img">
                </form>

                <p id="erro-msg">
                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    ?>
                </p>
                <div id="botao-voltar">
                    <a href="ordenaImagensForm.php?id=<?= $id ?>" class="botao-voltar-link">Voltar</a>
                </div>
            </div>
        </section>
    </main>
</body>

</html>