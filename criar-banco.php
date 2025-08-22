<?php

$dbPath = __DIR__ . '/Alpha.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$password = password_hash('123', PASSWORD_ARGON2ID);
$sql = "INSERT INTO administrador(name, email, password) VALUES (:name, :email, :password)";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', 'joão');
$stmt->bindValue(':email', 'email@example.com');
$stmt->bindValue(':password', $password);

$stmt->execute();