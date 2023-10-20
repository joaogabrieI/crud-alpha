<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=alpha', 'root' , 'Ch@bar345');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "erro na conexao" . $e->getMessage();
    die();
}