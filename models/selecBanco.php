<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "membrus_schemas";

try {
    // Conexão sem selecionar banco
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // Criar banco, se não existir
    $conn->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");

    // Selecionar banco
    $conn->exec("USE `$dbname`;");

    // Criar tabela membros
    $sql = "
    CREATE TABLE IF NOT EXISTS `membros` (
        `ID` int(11) NOT NULL AUTO_INCREMENT,
        `CPF` varchar(14) NOT NULL,
        `Nome_Completo` varchar(100) NOT NULL,
        `Data_Nascimento` date DEFAULT NULL,
        `Endereco` varchar(200) DEFAULT NULL,
        `CEP` varchar(9) DEFAULT NULL,
        `Email` varchar(100) DEFAULT NULL,
        `Celular` varchar(15) DEFAULT NULL,
        `Telefone` varchar(14) DEFAULT NULL,
        `Naturalidade` varchar(50) DEFAULT NULL,
        `Nacionalidade` varchar(50) DEFAULT 'Brasileira',
        `Batizado_Aguas` tinyint(1) DEFAULT 0,
        `Departamento` enum('Jovens','Senhoras','Missões','Crianças','Novos Convertidos','Varões','Adolescentes','Outro') DEFAULT NULL,
        `Cargo_Eclesiastico` enum('Membro','Diácono','Presbítero','Pastor','Missionário','Evangelista','Auxiliar','Líder','Coordenador') DEFAULT NULL,
        `Membro_Desde` date DEFAULT NULL,
        PRIMARY KEY (`ID`),
        UNIQUE KEY `CPF` (`CPF`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $conn->exec($sql);

    // Criar tabela usuários_login
    $sql = "
    CREATE TABLE IF NOT EXISTS `usuarios_login` (
      `ID` int(11) NOT NULL AUTO_INCREMENT,
      `Nome_Completo` varchar(50) NOT NULL,
      `Login_email` varchar(100) NOT NULL,
      `Senha` varchar(255) NOT NULL,
      `Cargo` enum('Coordenador','Secretário','Gerente') DEFAULT NULL,
      `Data_Criacao` timestamp NOT NULL DEFAULT current_timestamp(),
      `Ultimo_Login` timestamp NULL DEFAULT NULL,
      `Ativo` tinyint(1) DEFAULT 1,
      PRIMARY KEY (`ID`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $conn->exec($sql);


} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage() . ", recarregue a página.";
}

$conn = null;
?>