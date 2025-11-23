<?php

//Os includes necessários
@include_once __DIR__ . '../../config/config.php';
@include_once __DIR__ . '../../models/membrusModels.php';

// Chama a função para criar o membro se o formulário for submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    criarMembroAdmin();
}

$connection = getDbConnection();
$sql_code = "SELECT * FROM usuarios_login";
$result = $connection->query($sql_code);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/configuracoes.css">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./includes/header.css">
    <link rel="stylesheet" href="./includes/sidebar.css">

    <link rel="shortcut icon" href="./img/Membrus-Icone-removebg-preview.png" type="image/x-icon">
    <title>Membrus</title>
</head>
<body>
    
    <!--Inicio Header-->
        <?php include "../public/includes/header.php" ?>
    <!--Fim Header-->

    <!--Inicio Main-->
    <div id="main">

        <!--Inicio Sidebar-->
        <aside class="sidebar">
            <?php include "../public/includes/sidebar.php" ?>
        </aside>
        <!--Fim Sidebar-->

        <!--Inicio Content-->
        <section class="content">
            <h1>Configurações</h1>
            <p>Aqui vai o conteúdo principal</p>
            <div popover id="pop-cadastro-adm" class="pop-cadastro-adm">
                <form action="" class= "cadastro-adm" method="post">
                    <h1>Cadastro de Gestores</h1>
                    <label for="Nome_login">Nome Completo</label>
                    <input type="text" name="Nome_login" required>
                    <label for="Login_email">Email</label>
                    <input type="email" name="Login_email" required>
                    <label for="Senha_login">Senha</label>
                    <input type="password" name="Senha_login">
                    <label for="dropbox">Cargo</label>

                 <select class="dropbox"  name="Cargo">
                     <option value="">-- Selecione um Cargo --</option>
                     <option value="Coordenador">Coordenador</option>
                     <option value="Secretário">Secretário</option>
                     <option value="Gerente">Gerente</option>
                </select>

                    <button type="submit">Cadastrar</button>
        
                </form>
            </div>
            <button type="" popovertarget="pop-cadastro-adm" class="botao" >Cadastrar Administradores</button>
        </section>
        <!--Fim Content-->

        <!--Inicio Footer-->
        <footer>
            <!-- Será Adicionado Futuramente -->
        </footer>
        <!--Fim Footer-->

    </div>
    <!--Fim Main-->

</body>
</html>
