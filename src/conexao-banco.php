<?php
try{
    $pdo = new PDO( "sqlsrv:server=DESKTOP-POF56EJ\SQLEXPRESS; Database = Alpha", "", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "erro na conexao" . $e->getMessage();
    die();
}