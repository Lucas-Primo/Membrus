<?php

/**
 * Função para obter a conexão com o banco de dados.
 *
 * @return mysqli|null Retorna o objeto de conexão mysqli em caso de sucesso, ou null em caso de falha.
 */
function getDbConnection() {
    // Informa à função para usar as variáveis do escopo global.
    global $host, $usuario, $password, $database;

    // Desativa a exibição de erros para a conexão para tratar manualmente
    mysqli_report(MYSQLI_REPORT_OFF);

    $mysqli = new mysqli($host, $usuario, $password, $database);

    if ($mysqli->connect_error) {
        die("Falha na conexão com o banco de dados: " . $mysqli->connect_error);
    }

    return $mysqli;
}

//Função para cadastrar um novo membro administrativo
function criarMembroAdmin() {
    // Verificar se é uma requisição POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return false;
    }

    $connection = getDbConnection();
    
    // Coletar dados do formulário
    $nome = mysqli_real_escape_string($connection, $_POST['Nome_login']);
    $email = mysqli_real_escape_string($connection, $_POST['Login_email']);
    $senha = mysqli_real_escape_string($connection, $_POST['Senha_login']);
    $cargo = mysqli_real_escape_string($connection, $_POST['Cargo']);

    // Query de inserção
    $sql = "INSERT INTO usuarios_login (Nome_Completo, Login_email, Senha, Cargo) 
            VALUES ('$nome', '$email', '$senha', '$cargo' )";

    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo '<script>
                alert("Membro cadastrado com sucesso!");
                window.location.href = "configuracoes.php";
            </script>';
        return true;
    } else {
        echo '<script>
                alert("Erro ao cadastrar membro: ' . mysqli_error($connection) . '");
            </script>';
        return false;
    }

    mysqli_close($connection);
}

function criarMembro() {
    // Verificar se é uma requisição POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return false;
    }

    $connection = getDbConnection();
    
    // Coletar dados do formulário
    $cpf = mysqli_real_escape_string($connection, $_POST['cpf']);
    $nome_completo = mysqli_real_escape_string($connection, $_POST['nome_completo']);
    $data_nascimento = mysqli_real_escape_string($connection, $_POST['data_nascimento']);
    $endereco = mysqli_real_escape_string($connection, $_POST['endereco']);
    $cep = mysqli_real_escape_string($connection, $_POST['cep']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $celular = mysqli_real_escape_string($connection, $_POST['celular']);
    $telefone = mysqli_real_escape_string($connection, $_POST['telefone'] ?? '');
    $naturalidade = mysqli_real_escape_string($connection, $_POST['naturalidade']);
    $nacionalidade = mysqli_real_escape_string($connection, $_POST['nacionalidade']);
    $membro_desde = mysqli_real_escape_string($connection, $_POST['membro_desde']);
    $batizado_aguas = isset($_POST['Batizado_Aguas']) ? 1 : 0; // Trata o booleano: se o checkbox foi marcado, $_POST['Batizado_Aguas'] será '1'. Se não, não existirá.
    $departamento = mysqli_real_escape_string($connection, $_POST['Departamento'] ?? null);
    $cargo_eclesiastico = mysqli_real_escape_string($connection, $_POST['Cargo_Eclesiastico'] ?? 'Membro');

    // Query de inserção
    $sql = "INSERT INTO membros (CPF, Nome_Completo, Data_Nascimento, Endereco, CEP, Email, Celular, Telefone, Naturalidade, Nacionalidade, Batizado_Aguas, Departamento, Cargo_Eclesiastico, Membro_Desde) 
            VALUES ('$cpf', '$nome_completo', '$data_nascimento', '$endereco', '$cep', '$email', '$celular', '$telefone', '$naturalidade', '$nacionalidade', '$batizado_aguas', '$departamento', '$cargo_eclesiastico', '$membro_desde')";

    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo '<script>
                alert("Membro cadastrado com sucesso!");
                window.location.href = "cadastroMembro.php";
            </script>';
        return true;
    } else {
        echo '<script>
                alert("Erro ao cadastrar membro: ' . mysqli_error($connection) . '");
            </script>';
        return false;
    }

    mysqli_close($connection);
}

// Função para buscar todos os membros
function getAllMembros() {
    $connection = getDbConnection();
    
    if (!$connection) {
        return ['error' => 'Erro na conexão com o banco de dados'];
    }
    
    try {
        $sql_code = "SELECT * FROM membros ORDER BY Nome_Completo ASC";
        $result = $connection->query($sql_code);
        
        $membros = [];
        while ($row = $result->fetch_assoc()) {
            $membros[] = $row;
        }
        
        return $membros;
        
    } catch (Exception $e) {
        return ['error' => 'Erro ao buscar membros: ' . $e->getMessage()];
    }
}

// Função para buscar membro por ID
function getMembroById($id) {
    $connection = getDbConnection();
    
    if (!$connection) {
        return ['error' => 'Erro na conexão com o banco de dados'];
    }
    
    try {
        $sql_code = "SELECT * FROM membros WHERE ID = ?";
        $stmt = $connection->prepare($sql_code);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            return ['error' => 'Membro não encontrado'];
        }
        
        return $result->fetch_assoc();
        
    } catch (Exception $e) {
        return ['error' => 'Erro ao buscar membro: ' . $e->getMessage()];
    }
}

// Função para atualizar membro
function atualizarMembro($id) {
    $connection = getDbConnection();
    
    if (!$connection) {
        return ['error' => 'Erro na conexão com o banco de dados'];
    }
    
    try {
        // Preparar os dados
        $cpf = $_POST['cpf'];
        $nome_completo = $_POST['nome_completo'];
        $data_nascimento = $_POST['data_nascimento'];
        $endereco = $_POST['endereco'];
        $cep = $_POST['cep'];
        $email = $_POST['email'];
        $celular = $_POST['celular'];
        $telefone = $_POST['telefone'] ?? null;
        $naturalidade = $_POST['naturalidade'];
        $nacionalidade = $_POST['nacionalidade'];
        $batizado_aguas = isset($_POST['Batizado_Aguas']) ? 1 : 0;
        $departamento = $_POST['Departamento'];
        $cargo_eclesiastico = $_POST['Cargo_Eclesiastico'];
        $membro_desde = $_POST['membro_desde'];
        
        $sql_code = "UPDATE membros SET 
            CPF = ?, 
            Nome_Completo = ?, 
            Data_Nascimento = ?, 
            Endereco = ?, 
            CEP = ?, 
            Email = ?, 
            Celular = ?, 
            Telefone = ?, 
            Naturalidade = ?, 
            Nacionalidade = ?, 
            Batizado_Aguas = ?, 
            Departamento = ?, 
            Cargo_Eclesiastico = ?, 
            Membro_Desde = ?
        WHERE ID = ?";
        
        $stmt = $connection->prepare($sql_code);
        $stmt->bind_param(
            "ssssssssssisssi",
            $cpf,
            $nome_completo,
            $data_nascimento,
            $endereco,
            $cep,
            $email,
            $celular,
            $telefone,
            $naturalidade,
            $nacionalidade,
            $batizado_aguas,
            $departamento,
            $cargo_eclesiastico,
            $membro_desde,
            $id
        );
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return ['success' => 'Membro atualizado com sucesso!'];
            } else {
                return ['error' => 'Nenhuma alteração foi realizada.'];
            }
        } else {
            return ['error' => 'Erro ao atualizar membro: ' . $stmt->error];
        }
        
    } catch (Exception $e) {
        return ['error' => 'Erro: ' . $e->getMessage()];
    }
}

// Função para deletar membro
function deletarMembro($id) {
    $connection = getDbConnection();
    
    if (!$connection) {
        return ['error' => 'Erro na conexão com o banco de dados'];
    }
    
    try {
        // Primeiro verifica se o membro existe
        $membro = getMembroById($id);
        if (isset($membro['error'])) {
            return ['error' => 'Membro não encontrado'];
        }
        
        $sql_code = "DELETE FROM membros WHERE ID = ?";
        $stmt = $connection->prepare($sql_code);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return ['success' => 'Membro deletado com sucesso!'];
                header(Refresh: 0.1);
                exit;
            } else {
                return ['error' => 'Nenhum membro foi deletado.'];
            }
        } else {
            return ['error' => 'Erro ao deletar membro: ' . $stmt->error];
        }
        
    } catch (Exception $e) {
        return ['error' => 'Erro: ' . $e->getMessage()];
    }
}
 

//Função de login

function verificar_login() {

    // Inicia sessão se ainda não estiver iniciada
    if (!isset($_SESSION)) {
        session_start();
    }

    // Conexão com banco
    $mysqli = getDbConnection();

    // Verifica se email e senha foram enviados
    if (isset($_POST['email']) && isset($_POST['senha'])) {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        // Busca usuário
        $sql = "SELECT * FROM usuarios_login WHERE Login_email = '$email' AND Senha = '$senha'";
        $query = $mysqli->query($sql);

        if ($query->num_rows === 1) {

            $usuario = $query->fetch_assoc();

            // Armazena dados na sessão
            $_SESSION['id']   = $usuario['ID'];
            $_SESSION['nome'] = $usuario['Nome_Completo'];

            // Redireciona para home
            header("Location: public/home.php");

        } else {
            echo "<script>alert('Usuário ou senha incorretos.');</script>";
            header("Refresh: 0.1");
        }
    }
}


?>