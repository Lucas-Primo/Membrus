<?php

//Os includes necessários
@include_once __DIR__ . '/config/config.php';
@include_once __DIR__ . '/models/membrusModels.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificar_login();
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/app.css">
    <link rel="icon" type="image/png" href="caminho/para/seu/logo.png">
    <title>Membrus</title>
</head>
<body>
    
    <main>

        <div class="image">
    
        </div>

        <div class="login-conteiner">
            <h1>Login</h1>
            <div class="formulario">
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