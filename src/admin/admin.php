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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm</title>
</head>
<body>
    <a href="../../cadastroAdmin.php">Cadastrar novo usuário</a>
    <?php foreach ($usuarios as $usuario): ?>
    <table>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ativo</th>
            <th>Ações</th>
        </tr>
        <tr>
            <td><?= $usuario['adm_id'] ?></td>
            <td><?= $usuario['adm_nome'] ?></td>
            <td><?= $usuario['adm_email'] ?></td>
            <td><?= $usuario['adm_ativo'] === null ? 'Sim' : 'Não' ?></td>
            <td>
                <a href="#">Editar</a>
                <a href="excluiUsuario.php?id=<?= $usuario['adm_id'] ?>">Excluir</a>
            </td>
        </tr>
    </table>
    <?php endforeach; ?>
    <a href="logout.php">Sair</a>
</body>
</html>