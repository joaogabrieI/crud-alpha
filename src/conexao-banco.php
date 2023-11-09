<?php
try{
    // $pdo = new PDO('mysql:host=144.22.157.228;dbname=Alpha', 'Alpha' , 'Alpha');
    $pdo = new PDO( "sqlsrv:server=DESKTOP-POF56EJ\SQLEXPRESS; Database = Alpha", "", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "erro na conexao" . $e->getMessage();
    die();
}