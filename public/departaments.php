<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/departamentos.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="includes/header.css">
    <link rel="stylesheet" href="includes/sidebar.css">

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
            <h1>Gestão de Departamentos</h1>
            <p>Aqui vai o conteúdo principal</p>
            <button class="botao"  type="button" onClick="window.location.href='core/cadastroMembro.php'">Cadastrar Membros</button>
            <button class="botao" type="button" onclick="window.location.href='core/listarMembros.php'">Lista de Membros</button>
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
