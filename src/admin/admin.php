<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header('Location: ../../login.php');
        exit();
    }
    
    require "../conexao-banco.php";

    $sql = "SELECT * FROM administrador";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm</title>
</head>
<body>
    <?php foreach ($usuarios as $usuario): ?>
    <table>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ativo</th>
        </tr>
        <tr>
            <td><?= $usuario['adm_id'] ?></td>
            <td><?= $usuario['adm_nome'] ?></td>
            <td><?= $usuario['adm_email'] ?></td>
            <td><?= $usuario['adm_ativo'] ?></td>
            <td><a href="#">Editar</a></td>
            <td><a href="#">Excluir</a></td>
        </tr>
    </table>
    <?php endforeach; ?>
    <a href="logout.php">Sair</a>
</body>
</html>