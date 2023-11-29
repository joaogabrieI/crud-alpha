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
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$idProduto = $_GET["id"];

$sql2 = "SELECT * FROM PRODUTO p
JOIN CATEGORIA c 
    ON p.CATEGORIA_ID = c.CATEGORIA_ID 
JOIN PRODUTO_ESTOQUE pe
    ON p.PRODUTO_ID = pe.PRODUTO_ID
WHERE p.PRODUTO_ID = :id";
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindParam(":id", $idProduto, PDO::PARAM_INT);
$stmt2->execute();

$produtos = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$idCategoria = $_GET["categoria"];

$sql3 = "SELECT * FROM CATEGORIA WHERE CATEGORIA_ID != :id";
$stmt3 = $pdo->prepare($sql3);
$stmt3->bindParam(":id", $idCategoria, PDO::PARAM_INT);
$stmt3->execute();

$categorias = $stmt3->fetchAll(PDO::FETCH_ASSOC);

$sql4 = "SELECT * FROM PRODUTO_IMAGEM WHERE PRODUTO_ID = :id";
$stmt4 = $pdo->prepare($sql4);
$stmt4->bindParam(":id", $idProduto, PDO::PARAM_INT);
$stmt4->execute();

$imagens = $stmt4->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/style/produtos.css" />
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
      <p>Editar Produtos</p>
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

    <section id="containerCadastro">
      <div id="voltarParaLista">
        <button><a href="produtos.php">Voltar</a></button>
      </div>
      <?php foreach ($produtos as $produto) : ?>
        <form action="../src/produto/editaProdutos.php?id=<?= $produto['PRODUTO_ID'] ?>&categoria=<?= $produto['CATEGORIA_ID'] ?>" method="post" enctype="multipart/form-data" id="cadastro">

          <label for="nome">Nome do Produto</label>
          <input type="text" name="nome" id="" value="<?= $produto['PRODUTO_NOME'] ?>" required>
          <label for="descricao">Descrição do Produto</label>
          <input type="text" name="descricao" id="" value="<?= $produto['PRODUTO_DESC'] ?>" required>
          <label for="preco">Preço do Produto</label>
          <input type="number" name="preco" id="" step=".01" value="<?= $produto['PRODUTO_PRECO'] ?>" required>
          <label for="desconto">Desconto a ser aplicado</label>
          <input type="number" name="desconto" id="" value="<?= $produto['PRODUTO_DESCONTO'] ?>" required>
          <label for="qtd">Quantidade</label>
          <input type="number" name="qtd" id="" value="<?= $produto['PRODUTO_QTD'] ?>" required>
          <label for="categoria">Categoria</label>

          <select name="categoria" id="" required>
            <?php foreach ($categorias as $categoria) : ?>
              <option value="<?= $produto['CATEGORIA_ID'] ?>"><?= $produto['CATEGORIA_NOME'] ?></option>
              <option value="<?= $categoria['CATEGORIA_ID'] ?>"><?= $categoria['CATEGORIA_NOME'] ?></option>
            <?php endforeach; ?>
          </select>

          <p>Ativo</p>
          <label for="ativoSim">Sim</label>
          <input type="radio" name="ativo" id="" value="1" <?= $produto['PRODUTO_ATIVO'] === 1 ? 'checked' : '' ?>>

          <label for="ativoNão">Não</label>
          <input type="radio" name="ativo" id="" value="0" <?= $produto['PRODUTO_ATIVO'] === 0 ? 'checked' : '' ?>>

        <input type="submit" value="Editar" class="botaoCadastro">

        </form>
      <?php endforeach; ?>

      <p>
        <?php
        if (isset($_SESSION['msg'])) {
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
        }
        ?>
      </p>
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
</body>

</html>