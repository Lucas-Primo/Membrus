<?php

//Os includes necessários
@include_once __DIR__ . '/../../config/config.php';
@include_once __DIR__ . '/../../models/membrusModels.php';

// Chama a função para criar o membro se o formulário for submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    criarMembro();
}

$connection = getDbConnection();
$sql_code = "SELECT * FROM membros";
$result = $connection->query($sql_code);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/coreStyles/cadastroMembro.css"> 
    <title>Cadastrar Membro</title>
</head>
<body>

    <div class = "container-cadastro"><!-- Formulário de cadastro de membro -->
        <form class="formulario-cadastro" name="formulario-cadastro" action="" method="post">
            <h2>Cadastro</h2>
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" placeholder="123.456.789-00" maxlength="11" required>
            <label for="nome">Nome</label> 
            <input type="text" name="nome_completo" placeholder="Nome Completo" required>
            <label for="date">Data de Nascimento</label>
            <input type="date" name="data_nascimento" required>
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" placeholder="Rua das Lamentações 150" required>
            <label for="cep">CEP</label>
            <input type="text" name="cep" placeholder="12345-67" maxlength= "8" required>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="exemplo@exemplo.com" required>
            <label for="senha">Senha</label>
            <input type="password" name="senha" placeholder="senhaforte123" required>
            <label for="celular">Celular</label>
            <input type="text" name="celular" placeholder="(83) 91234-5678" maxlength="11" required>
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" placeholder="(83) 91234-5678" maxlength="11" required>
            <label for="naturaldiade">Naturalidade</label>
            <input type="text" name="naturalidade" placeholder="Paraibano" required>
            <label for="nacionalidade">Nacionalidade</label>
            <input type="text" name="nacionalidade" placeholder="Brasileiro" required>
            <label for="membro_desde">Membro Desde</label>
            <input type="date" name="membro_desde" placeholder="Membro Desde" required>
    
            <!-- Inicio Batismo -->
            <div class="batismo">
                <label class="batizado">Batizado nas Águas?</label>
                <div class="opcoes-batismo">
                    <div class="opcao-radio">
                        <input type="radio" name="Batizado_Aguas" id="batizado-sim" value="1">
                        <label for="batizado-sim">Sim</label>
                    </div>
                    <div class="opcao-radio">
                        <input type="radio" name="Batizado_Aguas" id="batizado-nao" value="0">
                        <label for="batizado-nao">Não</label>
                    </div>
                </div>
            </div>
            <!-- Fim Batismo -->

        <!-- Inicio Selects para Departamento e Cargo Eclesiástico -->
        <select class="dropbox"  name="Departamento">
            <option value="">-- Selecione um Departamento --</option>
            <option value="Jovens">Jovens</option>
            <option value="Senhoras">Senhoras</option>
            <option value="Missões">Missões</option>
            <option value="Crianças">Crianças</option>
            <option value="Novos Convertidos">Novos Convertidos</option>
            <option value="Varões">Varões</option>
            <option value="Adolescentes">Adolescentes</option>
            <option value="Outro">Outro</option>
        </select>

        <select class="dropbox" name="Cargo_Eclesiastico"> 
            <option value="Membro">Membro (Padrão)</option>
            <option value="Diácono">Diácono</option>
            <option value="Presbítero">Presbítero</option>
            <option value="Pastor">Pastor</option>
            <option value="Missionário">Missionário</option>
            <option value="Evangelista">Evangelista</option>
            <option value="Auxiliar">Auxiliar</option>
            <option value="Líder">Líder</option>
            <option value="Coordenador">Coordenador</option>
        </select>
        <!-- Fim Selects para Departamento e Cargo Eclesiástico -->

         <button type="submit" onclick>Cadastrar Membro</button>


        </div> 
    </form>
    
</body>
</html>