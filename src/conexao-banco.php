<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=cadastro', 'root' , '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "erro na conexao" . $e->getMessage();
    die();
}