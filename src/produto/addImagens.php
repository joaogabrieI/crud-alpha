<?php
session_start();

require_once "../conexao-banco.php";
require '../../vendor/autoload.php'; // Carregue o Guzzle

use GuzzleHttp\Client;

$id = $_GET['id'];

$sql = "SELECT IMAGEM_ID, IMAGEM_URL FROM PRODUTO_IMAGEM WHERE PRODUTO_ID = :id ORDER BY IMAGEM_ORDEM";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$imagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_FILES['imagem']['tmp_name'])) {
    $clientId = '649d99453e33b99';
    $ordem = count($imagens) + 1;

    foreach ($_FILES['imagem']['tmp_name'] as $key => $tmp_name) {
        // Configuração do cliente Guzzle
        $client = new Client(['verify' => false]);
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

                $stmt2->bindParam(":produtoid", $id, PDO::PARAM_INT);
                $stmt2->bindParam(":url", $url_imagem, PDO::PARAM_STR);
                $stmt2->bindParam(":ordem", $ordem, PDO::PARAM_INT);

                if ($stmt2->execute()) {
                    $_SESSION['msg'] = "Produto Cadastrado com sucesso!";
                    header("Location: ../../view/adicionaImagens.php?id=".$id);
                    $ordem++;
                } else {
                    $_SESSION['msg'] = 'Erro ao adicionar produto: ' . $stmt->errorInfo();
                    header("location: ../../view/adicionaImagens.php?id=".$id);
                }
            }
        } catch (\Exception $e) {
            $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
            header("Location: ../../view/adicionaImagens.php?id=".$id);
        }
    }
}
