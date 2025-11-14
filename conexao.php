<?php

$usuario = "root";
$password = "";
$database = "login_database";
$host = "localhost";

$mysqli = new mysqli($host, $usuario, $password, $database);

if($mysqli->error){
    die("Falha ao conectar com o banco de dados:P" . $mysqli->error);
}

?>