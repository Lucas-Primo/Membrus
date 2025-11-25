<section class="main">
<?php // variável que atribui a classe para usar o Active no CSS
    $pagina = basename($_SERVER['PHP_SELF']);
?>


    <!-- SIDEBAR -->
        <nav>
            <ul>
                <li><a href="./home.php" class="<?= ($pagina == 'home.php') ? 'active' : '' ?>"> 
                    <i class="fa-solid fa-house"></i> Início
                </a></li>

                <li><a href="./departaments.php" class="<?= ($pagina == 'departaments.php') ? 'active' : '' ?>">
                    <i class="fa-solid fa-user-group"></i> Departamentos
                </a></li>

                <li><a href="./calendar.php" class="<?= ($pagina == 'calendar.php') ? 'active' : '' ?>">
                    <i class="fa-solid fa-calendar-days"></i> Calendário
                </a></li>

                <li><a href="./tarefas.php" class="<?= ($pagina == 'tarefas.php') ? 'active' : '' ?>">
                    <i class="fa-solid fa-clipboard-list"></i> Tarefas
                </a></li>

                <li><a href="./relatorios.php" class="<?= ($pagina == 'relatorios.php') ? 'active' : '' ?>">
                    <i class="fa-solid fa-chart-simple"></i> Relatórios
                </a></li>

                <li><a href="./configuracoes.php" class="<?= ($pagina == 'configuracoes.php') ? 'active' : '' ?>">
                    <i class="fa-solid fa-gear"></i> Configurações
                </a></li>
            
            </ul>
        </nav>

    <!-- FIM SIDEBAR -->
     
</section>