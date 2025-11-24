<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<header>
    <div class="info-header">
        <div class="logo">
            <img src="./img/membrus-logo.png" alt = "Membrus" style="width:110px; height:auto;">
        </div>
    <i class="fa-solid fa-magnifying-glass"></i>
    </div>

    <div class="icons-header">
        <i class="fa-solid fa-bell"></i>

        <div class="user-menu-container">
            <i class="fa-regular fa-circle-user" id="userIcon"></i>


            <div class="user-popup" id="userPopup">
                <div class="user-info">
                    <p>Olá, <strong>NOME</strong></p>
                    <p class="email">email@mail.com</p>
                </div>

                <a href="logout.php" class="logoff-button">
                    <i class="fa-solid fa-right-from-bracket"></i> Sair / Logoff
                </a>

            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() { // Espera o html ser carregado
    const userIcon = document.getElementById('userIcon');
    const userPopup = document.getElementById('userPopup');

    // Para abrir e fechar quando clicar
    userIcon.addEventListener('click', function(e) {
        // se não ouver essa parte o click vai ser realizado em todos os elementos da página
        e.stopPropagation(); 
        
        // fica alternando entre esconder e mostrar o popup
        if (userPopup.style.display === 'block') {
            userPopup.style.display = 'none';
            userIcon.classList.remove('menu-open');
        } else {
            userPopup.style.display = 'block';
            userIcon.classList.add('menu-open');
        }
    });

    // Fechar o pop-up se o usuário clicar em qualquer outro lugar da página
    document.addEventListener('click', function(e) {
        // Para não fechar ao clicar dentro do popup
        const isClickInside = userPopup.contains(e.target) || userIcon.contains(e.target);
        
        if (!isClickInside) {
            userPopup.style.display = 'none';
            userIcon.classList.remove('menu-open');
        }
    });
});
</script>