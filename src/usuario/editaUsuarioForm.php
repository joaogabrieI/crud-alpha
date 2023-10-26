<?php session_start();
require "../conexao-banco.php";

$id = $_GET["id"];

$sql = "SELECT * FROM administrador WHERE adm_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php foreach ($usuarios as $usuario) : ?>
        <form action="editaUsuario.php?id=<?= $usuario['adm_id']?>" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required value="<?= $usuario['adm_nome'] ?>">

            <label for="email">Email</label>
            <input type="email" name="email" value="<?= $usuario['adm_email'] ?>" required>

            <input type="submit" value="Atualizar">
        </form>
    <?php endforeach ?>
    <p><?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?></p>
    <a href="usuarios.php">Voltar</a>
</body>

</html>