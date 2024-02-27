<?php
session_start();

require "../../vendor/autoload.php";

use Alpha\Domain\Infrastructure\Repository\PdoUserRepository;

$repo = new PdoUserRepository();
$repo->remove($_POST["id"]);


header("Location: ../../../view/usuarios.php");