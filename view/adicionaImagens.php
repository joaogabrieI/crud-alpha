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
</head>

<body>
    <main>
        <section>
            <!-- products.php - Página que exibe detalhes do produto e permite adicionar novas imagens -->
            <form action="../src/produto/addImagens.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
                <label for="imagem">Adicionar Novas Imagens:</label>
                <input type="file" name="imagem[]" multiple accept="image/*" required>

                <input type="submit" value="Adicionar Imagens">
            </form>

            <p>
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            </p>

        </section>

        <a href="ordenaImagensForm.php?id=<?=$id?>">Voltar</a>
    </main>
</body>

</html>