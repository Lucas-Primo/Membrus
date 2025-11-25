<?php

//Inicia a sessão caso não iniciada
if (!isset($_SESSION)){
    session_start();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
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
            <h1>Visão Geral</h1>
            <p>Aqui vai o conteúdo principal</p>

        <section class="cadastro-membros">
            <button class="botao" type="button" onclick="abrirPopupCadastro()">Cadastrar Membros</button>
        </section>

    <!-- Popup/Modal para cadastro -->
        <div id="popupCadastro" class="popup-overlay">
            <div class="popup-content">
                <div class="popup-header">
                    <h2>Cadastrar Novo Membro</h2>
                    <button class="popup-close" onclick="fecharPopupCadastro()">&times;</button>
                </div>
                <div class="popup-body">
                    <iframe src="./core/cadastroMembro.php" frameborder="0"></iframe>
                </div>
            </div>
        </div>

            <aside class="listarMembros">
                <iframe src="./core/listarMembros.php" frameborder="0"></iframe>
            </aside>

        </section>
        <!--Fim Content-->

        <!--Inicio Footer-->
        <footer>
            <!-- Será Adicionado Futuramente -->
        </footer>
        <!--Fim Footer-->

    </div>
    <!--Fim Main-->
    <script src="./script/fuctionsCRUD.js"></script>
</body>
</html>
