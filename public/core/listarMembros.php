<?php
@include_once __DIR__ . '/../../config/config.php';
@include_once __DIR__ . '/../../models/membrusModels.php';

// Buscar todos os membros
$membros = getAllMembros();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/coreStyles/listarMembros.css">
    <title>Lista de Membros</title>

</head>
<body>
    <div class="container">
        <h1>Lista Completa de Membros</h1>
        <button class="rtn-btn" onClick="window.location.href='../departaments.php'"><i class="fa-solid fa-x"></i></button>
        
        <!-- Cabeçalho com ação de criar novo membro e total de membros -->
        <div class="header-actions">
            <div class="total-members">
               
               <strong> Total de Membros cadastrados: <?php echo is_array($membros) ? count($membros) : 0; ?></strong>
            </div>
        </div>
        
        <!-- Mensagem de sucesso -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="success-msg">Membro cadastrado com sucesso!</div>
        <?php endif; ?>
        
        <!-- Mensagem de erro -->
        <?php if (isset($membros['error'])): ?>
            <p style="color: red;">Erro: <?php echo $membros['error']; ?></p>
        <?php elseif (empty($membros)): ?>
            <p>Nenhum membro cadastrado.</p>
        <?php else: ?>
            <!-- Tabela com todos os membros -->
            <div class="tabela-membros" >
            <table>
                <thead>
                    <tr class="titulos membros" >
                        <th>ID</th>
                        <th>Nome Completo</th>
                        <th>Data Nasc.</th>
                        <th>Email</th>
                        <th>Celular</th>
                        <th>Batizado</th>
                        <th>Departamento</th>
                        <th>Cargo</th>
                        <th>Membro Desde</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                </div>
                <tbody class="elementos-membros">
                    <?php foreach ($membros as $membro): ?>
                        <tr>
                            <td>#<?php echo htmlspecialchars($membro['ID']); ?></td>
                            <td><?php echo htmlspecialchars($membro['Nome_Completo']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($membro['Data_Nascimento'])); ?></td>
                            <td><?php echo htmlspecialchars($membro['Email']); ?></td>
                            <td><?php echo htmlspecialchars($membro['Celular']); ?></td>
                            <td class="ba<?php echo ($membro['Batizado_Aguas'] == 1) ? 'batizado-sim' : 'batizado-nao'; ?>">
                                <?php echo ($membro['Batizado_Aguas'] == 1) ? 'Sim' : 'Não'; ?>
                            </td>
                            <td><?php echo htmlspecialchars($membro['Departamento'] ?? '-'); ?></td>
                            <td><?php echo htmlspecialchars($membro['Cargo_Eclesiastico'] ?? 'Membro'); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($membro['Membro_Desde'])); ?></td>
                            <td class="actions">
                                <a href="verMembro.php?id=<?php echo $membro['ID']; ?>" class="btn-view" title="Visualizar Detalhes">
                                    <i class="fas fa-search-plus"></i>
                                </a>
                                <a href="editarMembro.php?id=<?php echo $membro['ID']; ?>" class="btn-edit" title="Editar Membro">
                                    <i class="fas fa-pen-alt"></i>
                                </a>
                                <a href="deletarMembro.php?id=<?php echo $membro['ID']; ?>" class="btn-delete" title="Excluir Membro" onclick="return confirm('Tem certeza que deseja excluir este membro?')">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>