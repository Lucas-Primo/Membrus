<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/calendar.css">
    <!-- <link rel="stylesheet" href="./css/global.css"> -->
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
                    <h1>Calendário de Eventos</h1>
                    <p>Aqui serão exibidos todos os eventos</p>
                    
                    <!--Alterar o calendário abaixo para o calendário da organização/empresa -->
                    <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=America%2FFortaleza&showTitle=0&showPrint=0&hl=pt_BR&src=NzRhOWQxNTVhZGQyNjRjZjE4NTI1OTU4NTI0MTgxN2NjNGM5YWNhMTliZTI2NWIwNmNhZThlODA0MGVhNzRmYkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%23a79b8e" style="border-width:0" width="1200" height="800" frameborder="0" scrolling="no" background-color="black"></iframe>
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
