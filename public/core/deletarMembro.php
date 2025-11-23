<?php
@include_once __DIR__ . '/../../config/config.php';
@include_once __DIR__ . '/../../models/membrusModels.php';

// Verificar se o ID foi passado na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: listarMbros.php?error=ID não especificado');
    exit;
}

$id = intval($_GET['id']);

// Processar o delete se confirmado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmar']) && $_POST['confirmar'] === 'sim') {
        $resultado = deletarMembro($id);
        
        if (isset($resultado['success'])) {
            header('Location: listarMembros.php?success=' . urlencode($resultado['success']));
            exit;
        } else {
            $mensagem_erro = $resultado['error'];
        }
    } else {
        // Se cancelou, volta para a lista
        header('Location: listarMembros.php');
        exit;
    }
}

// Buscar dados do membro para mostrar na confirmação
$membro = getMembroById($id);

// Verificar se houve erro na busca
if (isset($membro['error'])) {
    header('Location: listarMembros.php?error=' . urlencode($membro['error']));
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/core/deletarMembro.css">
    <title>Deletar Membro - <?php echo htmlspecialchars($membro['Nome_Completo']); ?></title>
    
</head>
<body>
    <div class="container">
        <div class="warning-card">
            
            <h1>Confirmaçao de Exclusão</h1>
            
            <strong>
            <p style="color: red ;  margin-bottom: 25px; font-size: 1.1rem;">
                Você está prestes a deletar permanentemente um membro do sistema!
            </p>
            </strong>

            <!-- Informações do membro -->
            <div class="member-info">
                <h3>Membro a ser deletado:</h3>
                <div class="info-item">
                    <span class="info-label">ID:</span>
                    <span class="info-value"><?php echo htmlspecialchars($membro['ID']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Nome:</span>
                    <span class="info-value"><strong><?php echo htmlspecialchars($membro['Nome_Completo']); ?></strong></span>
                </div>
                <div class="info-item">
                    <span class="info-label">CPF:</span>
                    <span class="info-value"><?php echo htmlspecialchars($membro['CPF']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span>
                    <span class="info-value"><?php echo htmlspecialchars($membro['Email']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Membro desde:</span>
                    <span class="info-value"><?php echo date('d/m/Y', strtotime($membro['Membro_Desde'])); ?></span>
                </div>
            </div>

            <!-- Aviso importante -->
            <div class="warning-text">
                <br>
                <strong>ATENÇÃO:</strong> Esta ação <strong>NÃO</strong> pode ser desfeita! Todos os dados deste membro serão <strong>pemanentemente excluídos.</strong>
            </div>

            <!-- Mensagens de erro -->
            <?php if (isset($mensagem_erro)): ?>
                <div class="message error">
                    ❌ <?php echo $mensagem_erro; ?>
                </div>
            <?php endif; ?>

            <!-- Formulário de confirmação -->
            <form action="" method="post">
                <div class="actions">
                    <button onClick=" window.location.href='listarMembros.php?id=<?php echo $membro['ID']; ?>'" class="btn btn-cancel">
                    Cancelar
                    </button>
                  
                    <button type="submit" name="confirmar" value="sim" class="btn btn-delete" onclick="return confirm('Tem certeza ABSOLUTA que deseja deletar este membro? Esta ação é IRREVERSÍVEL!');">
                        Deletar
                    </button>
                    
                </div>
            </form>
        </div>
    </div>

    <script>
        // Confirmação adicional
        document.addEventListener('DOMContentLoaded', function() {
            const deleteBtn = document.querySelector('.btn-delete');
            
            if (deleteBtn) {
                deleteBtn.addEventListener('click', function(e) {
                    const memberName = '<?php echo addslashes($membro['Nome_Completo']); ?>';
                    const confirmation = confirm(`CONFIRMAÇÃO FINAL:\n\nVocê está deletando:\n${memberName}\n\nEsta ação é PERMANENTE e IRREVERSÍVEL!\n\nClique em OK para confirmar ou Cancelar para abortar.`);
                    
                    if (!confirmation) {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>
</body>
</html>