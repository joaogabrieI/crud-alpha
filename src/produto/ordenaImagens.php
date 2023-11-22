<?php

session_start();

require "../conexao-banco.php";

$idProduto = $_POST['produtoID'];
$ordens = $_POST['ordem'];

try{
    $pdo->beginTransaction();

    foreach ($ordens as $idImagem => $ordem) {
        $atualizarOrdem = $pdo->prepare("UPDATE PRODUTO_IMAGEM SET IMAGEM_ORDEM = :ordem WHERE IMAGEM_ID = :id");
        $atualizarOrdem->bindParam(':ordem', $ordem);
        $atualizarOrdem->bindParam(':id', $idImagem);
        $atualizarOrdem->execute();
    }

    $pdo->commit();
    header("Location: ../../view/produtos.php");
    $_SESSION['msg'] = "Ordem das imagens alterada com sucesso!";
} catch (PDOException $e){
    $pdo->rollBack();
    $_SESSION['msg'] = "Erro ao atualizar a ordem das imagens: " . $e->getMessage();
    header("Location: ../../view/ordenaImagens.php?id=".$idProduto);
}


