<?php
@include_once __DIR__ . '/../../config/config.php';
@include_once __DIR__ . '/../../models/membrusModels.php';

// Verificar se o ID foi passado na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: listar_membros.php?error=ID não especificado');
    exit;
}

$id = intval($_GET['id']);

// Processar o formulário de atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = atualizarMembro($id);
    
    if (isset($resultado['success'])) {
        $mensagem_sucesso = $resultado['success'];
    } else {
        $mensagem_erro = $resultado['error'];
    }
}

// Buscar dados do membro
$membro = getMembroById($id);

// Verificar se houve erro na busca
if (isset($membro['error'])) {
    header('Location: listar_membros.php?error=' . urlencode($membro['error']));
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/coreStyles/editarMembro.css">
    <title>Editar Membro - <?php echo htmlspecialchars($membro['Nome_Completo']); ?></title>
    
</head>
<body>
    <div class="container">
        <!-- Cabeçalho -->
        <div class="header">
            <h1>Editar Membro</h1>
            <div class="member-id">ID: <?php echo htmlspecialchars($membro['ID']); ?> - <?php echo htmlspecialchars($membro['Nome_Completo']); ?></div>
        </div>

        <!-- Mensagens -->
        <?php if (isset($mensagem_sucesso)): ?>
            <div class="message success">
                ✅ <?php echo $mensagem_sucesso; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($mensagem_erro)): ?>
            <div class="message error">
                ❌ <?php echo $mensagem_erro; ?>
            </div>
        <?php endif; ?>

        <!-- Formulário de Edição -->
        <div class="form-container">
            <form action="" method="post">
                <div class="form-grid">
                    <!-- Informações Pessoais -->
                    <div class="form-group">
                        <label for="cpf">CPF *</label>
                        <input type="text" name="cpf" id="cpf" value="<?php echo htmlspecialchars($membro['CPF']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nome_completo">Nome Completo *</label>
                        <input type="text" name="nome_completo" id="nome_completo" value="<?php echo htmlspecialchars($membro['Nome_Completo']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento *</label>
                        <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo htmlspecialchars($membro['Data_Nascimento']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="naturalidade">Naturalidade *</label>
                        <input type="text" name="naturalidade" id="naturalidade" value="<?php echo htmlspecialchars($membro['Naturalidade']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nacionalidade">Nacionalidade *</label>
                        <input type="text" name="nacionalidade" id="nacionalidade" value="<?php echo htmlspecialchars($membro['Nacionalidade']); ?>" required>
                    </div>

                    <!-- Contato -->
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($membro['Email']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="celular">Celular *</label>
                        <input type="text" name="celular" id="celular" value="<?php echo htmlspecialchars($membro['Celular']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($membro['Telefone'] ?? ''); ?>">
                    </div>

                    <!-- Endereço -->
                    <div class="form-group full-width">
                        <label for="endereco">Endereço *</label>
                        <input type="text" name="endereco" id="endereco" value="<?php echo htmlspecialchars($membro['Endereco']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="cep">CEP *</label>
                        <input type="text" name="cep" id="cep" value="<?php echo htmlspecialchars($membro['CEP']); ?>" required>
                    </div>

                    <!-- Informações Eclesiásticas -->
                    <div class="form-group">
                        <label for="membro_desde">Membro Desde *</label>
                        <input type="date" name="membro_desde" id="membro_desde" value="<?php echo htmlspecialchars($membro['Membro_Desde']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Batizado nas Águas?</label>
                        <div class="checkbox-group">
                            <input type="checkbox" name="Batizado_Aguas" id="batizado_aguas" value="1" <?php echo ($membro['Batizado_Aguas'] == 1) ? 'checked' : ''; ?>>
                            <label for="batizado_aguas" style="margin: 0;">Sim</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Departamento">Departamento</label>
                        <select name="Departamento" id="Departamento">
                            <option value="">-- Selecione um Departamento --</option>
                            <option value="Jovens" <?php echo ($membro['Departamento'] == 'Jovens') ? 'selected' : ''; ?>>Jovens</option>
                            <option value="Senhoras" <?php echo ($membro['Departamento'] == 'Senhoras') ? 'selected' : ''; ?>>Senhoras</option>
                            <option value="Missões" <?php echo ($membro['Departamento'] == 'Missões') ? 'selected' : ''; ?>>Missões</option>
                            <option value="Crianças" <?php echo ($membro['Departamento'] == 'Crianças') ? 'selected' : ''; ?>>Crianças</option>
                            <option value="Novos Convertidos" <?php echo ($membro['Departamento'] == 'Novos Convertidos') ? 'selected' : ''; ?>>Novos Convertidos</option>
                            <option value="Varões" <?php echo ($membro['Departamento'] == 'Varões') ? 'selected' : ''; ?>>Varões</option>
                            <option value="Adolescentes" <?php echo ($membro['Departamento'] == 'Adolescentes') ? 'selected' : ''; ?>>Adolescentes</option>
                            <option value="Outro" <?php echo ($membro['Departamento'] == 'Outro') ? 'selected' : ''; ?>>Outro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Cargo_Eclesiastico">Cargo Eclesiástico</label>
                        <select name="Cargo_Eclesiastico" id="Cargo_Eclesiastico">
                            <option value="Membro" <?php echo ($membro['Cargo_Eclesiastico'] == 'Membro') ? 'selected' : ''; ?>>Membro (Padrão)</option>
                            <option value="Diácono" <?php echo ($membro['Cargo_Eclesiastico'] == 'Diácono') ? 'selected' : ''; ?>>Diácono</option>
                            <option value="Presbítero" <?php echo ($membro['Cargo_Eclesiastico'] == 'Presbítero') ? 'selected' : ''; ?>>Presbítero</option>
                            <option value="Pastor" <?php echo ($membro['Cargo_Eclesiastico'] == 'Pastor') ? 'selected' : ''; ?>>Pastor</option>
                            <option value="Missionário" <?php echo ($membro['Cargo_Eclesiastico'] == 'Missionário') ? 'selected' : ''; ?>>Missionário</option>
                            <option value="Evangelista" <?php echo ($membro['Cargo_Eclesiastico'] == 'Evangelista') ? 'selected' : ''; ?>>Evangelista</option>
                            <option value="Auxiliar" <?php echo ($membro['Cargo_Eclesiastico'] == 'Auxiliar') ? 'selected' : ''; ?>>Auxiliar</option>
                            <option value="Líder" <?php echo ($membro['Cargo_Eclesiastico'] == 'Líder') ? 'selected' : ''; ?>>Líder</option>
                            <option value="Coordenador" <?php echo ($membro['Cargo_Eclesiastico'] == 'Coordenador') ? 'selected' : ''; ?>>Coordenador</option>
                        </select>
                    </div>
                </div>

                <!-- Botões de ação -->
                <div class="actions">
                    <button type="submit" class="btn btn-submit"> <p>Salvar alterações</p></button>
                    <a href="listarMembros.php" class="btn btn-cancel">
                        <p>Cancelar</p>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Validação básica do formulário
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let valid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        valid = false;
                        field.style.borderColor = '#dc3545';
                    } else {
                        field.style.borderColor = '#e0e0e0';
                    }
                });
                
                if (!valid) {
                    e.preventDefault();
                    alert('Por favor, preencha todos os campos obrigatórios.');
                }
            });
        });
    </script>
</body>
</html>