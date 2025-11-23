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
    <link rel="stylesheet" href="../css/core/verMembro.css">
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
        <div class="details-grid">
            <!-- Informações Pessoais -->
            <div class="detail-card">
                <u><h3>Informações Pessoais</h3></u>
                <br>
                <fieldset>
                <div class="detail-item">
                    <span class="detail-label">CPF:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($membro['CPF']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Data Nasc.:</span>
                    <span class="detail-value"><?php echo date('d/m/Y', strtotime($membro['Data_Nascimento'])); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Naturalidade:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($membro['Naturalidade']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Nacionalidade:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($membro['Nacionalidade']); ?></span>
                </div>
                </fieldset>
            </div>

            <!-- Informações de Contato -->
            <div class="detail-card">
                <u><h3>Contato</h3></u>
              <fieldset>
                <div class="detail-item">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($membro['Email']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Celular:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($membro['Celular']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Telefone:</span>
                    <span class="detail-value">
                        <?php echo !empty($membro['Telefone']) ? htmlspecialchars($membro['Telefone']) : '<span class="empty-field">Não informado</span>'; ?>
                    </span>
                </div>
              </fieldset>
            </div>

            <!-- Endereço -->
            <div class="detail-card">
                <u><h3>Endereço</h3></u>
              <fieldset>
                <u><div class="detail-item"></u>
                    <span class="detail-label">Endereço:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($membro['Endereco']); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">CEP:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($membro['CEP']); ?></span>
                </div>
              </fieldset>
            </div>

            <!-- Informações Eclesiásticas -->
            <div class="detail-card">
                <u><h3>Informações Eclesiásticas</h3></u>
              <fieldset>
                <div class="detail-item">
                    <span class="detail-label">Membro desde:</span>
                    <span class="detail-value"><?php echo date('d/m/Y', strtotime($membro['Membro_Desde'])); ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Batizado:</span>
                    <span class="detail-value">
                        <span class="badge <?php echo ($membro['Batizado_Aguas'] == 1) ? 'badge-batizado' : 'badge-nao-batizado'; ?>">
                            <?php echo ($membro['Batizado_Aguas'] == 1) ? 'Sim' : 'Não'; ?>
                        </span>
                    </span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Departamento:</span>
                    <span class="detail-value">
                        <?php if (!empty($membro['Departamento'])): ?>
                            <span class="badge badge-departamento"><?php echo htmlspecialchars($membro['Departamento']); ?></span>
                        <?php else: ?>
                            <span class="empty-field">Não definido</span>
                        <?php endif; ?>
                    </span>
                  
                </div>
                <div class="detail-item">
                    <span class="detail-label">Cargo:</span>
                    <span class="detail-value">
                        <span class="badge badge-cargo"><?php echo htmlspecialchars($membro['Cargo_Eclesiastico'] ?? 'Membro'); ?></span>
                    </span>
                </div>
              </fieldset>
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