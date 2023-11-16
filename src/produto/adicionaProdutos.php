<?php

session_start();

require "../conexao-banco.php";
require '../../vendor/autoload.php'; // Carregue o Guzzle

use GuzzleHttp\Client;

$nome = filter_input(INPUT_POST, "nome", FILTER_DEFAULT);
$descricao = filter_input(INPUT_POST, "descricao", FILTER_DEFAULT);
$preco = floatval(filter_input(INPUT_POST, "preco", FILTER_DEFAULT));
$desconto = floatval(filter_input(INPUT_POST, "desconto", FILTER_DEFAULT));
$categoria = filter_input(INPUT_POST, "categoria", FILTER_DEFAULT);
$qtd = filter_input(INPUT_POST, "qtd", FILTER_DEFAULT);


$sql = "INSERT INTO PRODUTO (PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, CATEGORIA_ID, PRODUTO_ATIVO) VALUES (:nome, :descricao, :preco, :desconto, :categoria, 1)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
$stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
$stmt->bindParam(":preco", $preco, PDO::PARAM_INT);
$stmt->bindParam(":desconto", $desconto, PDO::PARAM_INT);
$stmt->bindParam(":categoria", $categoria, PDO::PARAM_INT);

$clientId = '649d99453e33b99';

if ($stmt->execute()) {
    $produto_id = $pdo->lastInsertId();

    $sql3 = "INSERT INTO PRODUTO_ESTOQUE (PRODUTO_ID, PRODUTO_QTD) VALUES (:produtoid, :qtd)";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->bindParam(":produtoid", $produto_id, PDO::PARAM_INT);
    $stmt3->bindParam(":qtd", $qtd, PDO::PARAM_INT);

    if ($stmt3->execute()) {
        if (isset($_FILES['imagem']['tmp_name'])) {
            foreach ($_FILES['imagem']['tmp_name'] as $key => $tmp_name) {
                // Configuração do cliente Guzzle
                $client = new Client(['verify' => false]);
                $ordem = $key + 1;


                try {
                    // upload da imagem para o Imgur
                    $response = $client->request('POST', 'https://api.imgur.com/3/image', [
                        'headers' => [
                            'Authorization' => 'Client-ID ' . $clientId,
                        ],
                        'multipart' => [
                            [
                                'name' => 'image',
                                'contents' => fopen($tmp_name, 'r'),
                            ],
                        ],
                    ]);

                    $data = json_decode($response->getBody(), true);

                    if (isset($data['data']['link'])) {
                        $url_imagem = $data['data']['link'];
                        
                        $sql2 = "INSERT INTO PRODUTO_IMAGEM(IMAGEM_ORDEM, PRODUTO_ID, IMAGEM_URL) VALUES (:ordem, :produtoid, :url)";
                        $stmt2 = $pdo->prepare($sql2);

                        $stmt2->bindParam(":produtoid", $produto_id, PDO::PARAM_INT);
                        $stmt2->bindParam(":url", $url_imagem, PDO::PARAM_STR);
                        $stmt2->bindParam(":ordem", $ordem, PDO::PARAM_INT);

                        if ($stmt2->execute()) {
                            $_SESSION['msg'] = "Imagem adicionada com sucesso!";
                            header("Location: ../../view/adicionaProdutoForm.php");
                        } else {
                            $_SESSION['msg'] = 'Erro ao adicionar imagem: ' . $stmt->errorInfo();
                            header("location: ../../view/adicionaProdutoForm.php");
                        }
                    }
                } catch (\Exception $e) {
                    $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
                    header('Location: ../../view/adicionaProdutoForm.php');
                }
            }
        }
    } else {
        $$_SESSION['msg'] = 'Erro ao quantidade do produto: ' . $stmt->errorInfo();
        header("location: ../../view/adicionaProdutoForm.php");
    }
} else {
    $_SESSION['msg'] = 'Erro ao adicionar produto: ' . $stmt->errorInfo();
    header("location: ../../view/adicionaProdutoForm.php");
}
