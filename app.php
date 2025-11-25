<?php

//Os includes necessários
@include_once __DIR__ . '/config/config.php';
@include_once __DIR__ . '/models/membrusModels.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificar_login();
    exit;
}
?>

<?php

//Criar o banco caso não existir
    include("models/selecBanco.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/app.css">
    <link rel="shortcut icon" href="public/img/Membrus-Icone-removebg-preview.png" type="image/x-icon">
    <title>Membrus</title>
</head>
<body>
    
    <main>

    
        <div class="login-conteiner">

            
            <div class="formulario">

                <div class="image">
                    <img src="./public/img/Membrus-Logo-Azul 2.png" alt="">
                </div>
                <form action="app.php" method="post">
                    <p>E-mail</p>
                    <input type="email" id="email" name="email" required>
                    <p>Password</p>
                    <input type="password" id="password" name="senha" required>
                
                    <button type="submit">Entrar</button>
                
                </form>
            </div>
        </div> 
    </main>
</body>
</html>