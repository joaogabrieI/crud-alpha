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

$sql = "SELECT * FROM CATEGORIA";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/style/adc-produto.css" />
  <link rel="shortcut icon" type="imagex/png" href="../assets/img/logo.ico">
  <title>Admin</title>
</head>

<body>
  <header>
    <nav>
      <div class="logo">
        <img id="logo" src="../assets/img/icon-logo2.png" alt="" />
      </div>
      <p>Cadastro Produtos</p>
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
        <img src="../assets//img/voltar.png" alt="" class="return">
        <a href="produtos.php"><button class="btn-voltar">Voltar</button></a>
      </div>

      <form action="../src/produto/adicionaProdutos.php" method="post" enctype="multipart/form-data" id="cadastro">

        <label for="nome">Nome do Produto:</label>
        <input class="inputs" type="text" name="nome" id="">

        <label for="descricao">Descrição do Produto:</label>
        <input class="inputs" type="text" name="descricao" id="">

        <label for="preco" class="preco">Preço do Produto:</label>
        <input class="inputs" type="number" name="preco" step=".01" id="">

        <label for="qtd">Quantidade:</label>
        <input class="inputs" type="number" name="qtd" id="">

        <label for="desconto">Desconto a ser aplicado:</label>
        <input class="inputs" type="number" name="desconto" id="">

        <label for="categoria">Categoria:</label>

        <select name="categoria" id="">
          <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['CATEGORIA_ID'] ?>">
              <?= $categoria['CATEGORIA_NOME'] ?>
            </option>
          <?php endforeach; ?>
        </select>

        <div class="add-imgs">
          <label for="imagem">Imagem Produto</label>
          <input type="file" name="imagem[]" multiple accept="image/*">
        </div>
        <input type="submit" value="Cadastrar" class="botaoCadastro">

      </form>

      <div>
        <p id="error-msg">
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

  <?php foreach ($usuarios as $usuario): ?>
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