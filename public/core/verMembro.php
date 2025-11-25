<?php
@include_once __DIR__ . '/../../config/config.php';
@include_once __DIR__ . '/../../models/membrusModels.php';

// Verificar se o ID foi passado na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: listar_membros.php?error=ID não especificado');
    exit;
}

$id = intval($_GET['id']);
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
    <link rel="stylesheet" href="../css/coreStyles/verMembro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Detalhes do Membro - <?php echo htmlspecialchars($membro['Nome_Completo']); ?></title>
    
</head>
<body>
    <div class="container">
        <!-- Cabeçalho com informações principais -->
        <div class="header">
            <h1><?php echo htmlspecialchars($membro['Nome_Completo']); ?></h1>
            <div class="member-id">ID: #<?php echo htmlspecialchars($membro['ID']); ?></div>
        </div>

        <!-- Grid de informações -->
       <div class="form-container">
            <div class="form-grid">
                <!-- Informações Pessoais -->
                <div class="form-group">
                    <label>CPF</label>
                    <div class="detail-value"><?php echo htmlspecialchars($membro['CPF']); ?></div>
                </div>

                <div class="form-group">
                    <label>Nome Completo</label>
                    <div class="detail-value"><?php echo htmlspecialchars($membro['Nome_Completo']); ?></div>
                </div>

                <div class="form-group">
                    <label>Data de Nascimento</label>
                    <div class="detail-value"><?php echo date('d/m/Y', strtotime($membro['Data_Nascimento'])); ?></div>
                </div>

                <div class="form-group">
                    <label>Naturalidade</label>
                    <div class="detail-value"><?php echo htmlspecialchars($membro['Naturalidade']); ?></div>
                </div>

                <div class="form-group">
                    <label>Nacionalidade</label>
                    <div class="detail-value"><?php echo htmlspecialchars($membro['Nacionalidade']); ?></div>
                </div>

                <!-- Contato -->
                <div class="form-group">
                    <label>Email</label>
                    <div class="detail-value"><?php echo htmlspecialchars($membro['Email']); ?></div>
                </div>

                <div class="form-group">
                    <label>Celular</label>
                    <div class="detail-value"><?php echo htmlspecialchars($membro['Celular']); ?></div>
                </div>

                <div class="form-group">
                    <label>Telefone</label>
                    <div class="detail-value">
                        <?php echo !empty($membro['Telefone']) ? htmlspecialchars($membro['Telefone']) : '<span class="empty-field">Não informado</span>'; ?>
                    </div>
                </div>

                <!-- Endereço -->
                <div class="form-group full-width">
                    <label>Endereço</label>
                    <div class="detail-value"><?php echo htmlspecialchars($membro['Endereco']); ?></div>
                </div>

                <div class="form-group">
                    <label>CEP</label>
                    <div class="detail-value"><?php echo htmlspecialchars($membro['CEP']); ?></div>
                </div>

                <!-- Informações Eclesiásticas -->
                <div class="form-group">
                    <label>Membro Desde</label>
                    <div class="detail-value"><?php echo date('d/m/Y', strtotime($membro['Membro_Desde'])); ?></div>
                </div>

                <div class="form-group">
                    <label>Batizado nas Águas?</label>
                    <div class="detail-value">
                        <span class="badge <?php echo ($membro['Batizado_Aguas'] == 1) ? 'badge-batizado' : 'badge-nao-batizado'; ?>">
                            <?php echo ($membro['Batizado_Aguas'] == 1) ? 'Sim' : 'Não'; ?>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Departamento</label>
                    <div class="detail-value">
                        <?php if (!empty($membro['Departamento'])): ?>
                            <span class="badge badge-departamento"><?php echo htmlspecialchars($membro['Departamento']); ?></span>
                        <?php else: ?>
                            <span class="empty-field">Não definido</span>
                        <?php endif; ?>
                    </div>
                </div>
                        
                <div class="form-group">
                    <label>Cargo Eclesiástico</label>
                    <div class="detail-value">
                        <span class="badge badge-cargo"><?php echo htmlspecialchars($membro['Cargo_Eclesiastico'] ?? 'Membro'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botões de ação -->
        <div class="actions">
            <a href="listarMembros.php" class="btn btn-back">
                <i class="fa-solid fa-x"></i>
            </a>
            <a href="editarMembro.php?id=<?php echo $membro['ID']; ?>" class="btn btn-edit"><i class="fa-regular fa-pen-to-square"></i>Editar Info
            </a>
             <a href="deletarMembro.php?id=<?php echo $membro['ID']; ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja deletar este membro?')">
                <i class="fa-solid fa-trash"></i>Deletar Cadastro
            </a>
            <button onclick="window.print()" class="btn btn-print"><i class="fa-solid fa-print"></i>Imprimir
            </button>
        </div>
    </div>

    <script>
        // Adiciona confirmação antes de editar (opcional)
        document.addEventListener('DOMContentLoaded', function() {
            const editBtn = document.querySelector('.btn-edit');
            if (editBtn) {
                editBtn.addEventListener('click', function(e) {
                    if (!confirm('Deseja editar as informações deste membro?')) {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>
</body>
</html>