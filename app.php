<?php

include("conexao.php");

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
                <form action="app.php" method="POST">
                    <p>E-mail</p>
                    <input type="email" id="email" name="email">
                    <p>Password</p>
                    <input type="password" id="password" name="password">
                
                    <button type="button" onclick="window.location.href='public/home.html'">Entrar</button>
                     <button type="button" popovertarget="popup-cadastro">Cadastre-se</button>

                        <div id="popup-cadastro" popover>
                            <h1>Cadastro</h1>
                                <form action="conexao.php" method="POST">
                                    <p>Nome</p>
                                    <input type="name" name="nome" id="nome">

                                    <p>Sobrenome</p>
                                    <input type="surname" name="sobrenome" id="sobrenome">

                                    <p>Data de Nascimento</p>
                                    <input type="date" name="data-nascimento" id="data-nascimento">

                                    <p>Email</p>
                                    <input type="email" name="email-cadastro" id="email-cadastro">

                                    <p>Senha</p>
                                    <input type="password" name="senha" id="senha-cadastro">

                                    <p>Sexo</p>
                                    <fieldset>
                                     <input type="radio" id="feminino" name="sexo" value="f" >
                                     <label for="feminino" class="inline">Feminino</label>
                                      <input type="radio" id="masculino" name="sexo" value="m">
                                      <label for="masculino" class="inline">Masculino</label>
                                        <input type="radio" id="nao-dizer" name="sexo" value="">
                                        <label for="nao-dizer">Prefiro não dizer</label>
                                    </fieldset>
                                 <button type="submit" name="cadastro" id="botao-submit">Enviar</button> 

                                </form>
                </form>
            </div>
        </div> 
    </main>
    <script src="index.js"></script>
</body>
</html>
<?php

//Verificação das Variáveis e link com vairveis em php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST["nome"] ?? '';
    $sobrenome = $_POST["sobrenome"] ?? '';
    $data_nasc = $_POST["data-nascimento"] ?? '';
    $email = $_POST["email-cadastro"] ?? '';
    $senha = $_POST["senha"] ?? '';
    $sexo = $_POST["sexo"] ?? '';

    // Criptografa a senha (recomendado)
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Monta a query de inserção
    //Atrela as variáveis POST com os fatores do banco de dados
    $sql = "INSERT INTO `info-cadastro` 
            (nome, sobrenome, data_nasc, email, senha, genero)
            VALUES ('$nome', '$sobrenome', '$data_nasc', '$email', '$senha_hash', '$sexo')";

    //Verificação de cadastro
    if ($mysqli->query($sql)) {
        
        echo"
        ";
    } else {
        echo "Erro ao cadastrar: " . $mysqli->error;
    }
        // Fecha a conexão
        $mysqli->close();
        



} else {
    echo "Erro, nenhum dado enviado.";
}
?>