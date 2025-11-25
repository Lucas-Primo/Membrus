//CPF inicio

function validaCPF(cpf) {
  var Soma = 0
  var Resto

  var strCPF = String(cpf).replace(/[^\d]/g, '')
  
  if (strCPF.length !== 11)
     return false
  
  if ([
    '00000000000',
    '11111111111',
    '22222222222',
    '33333333333',
    '44444444444',
    '55555555555',
    '66666666666',
    '77777777777',
    '88888888888',
    '99999999999',
    ].indexOf(strCPF) !== -1)
    return false

  for (i=1; i<=9; i++)
    Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);

  Resto = (Soma * 10) % 11

  if ((Resto == 10) || (Resto == 11)) 
    Resto = 0

  if (Resto != parseInt(strCPF.substring(9, 10)) )
    return false

  Soma = 0

  for (i = 1; i <= 10; i++)
    Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i)

  Resto = (Soma * 10) % 11

  if ((Resto == 10) || (Resto == 11)) 
    Resto = 0

  if (Resto != parseInt(strCPF.substring(10, 11) ) )
    return false

  return true
}

// Funções para abrir e fechar o popup
function abrirPopupCadastro() {
    document.getElementById('popupCadastro').style.display = 'flex';
    document.body.style.overflow = 'hidden'; // Previne scroll da página principal
}

function fecharPopupCadastro() {
    document.getElementById('popupCadastro').style.display = 'none';
    document.body.style.overflow = 'auto'; // Restaura scroll
}

// Fechar popup clicando fora do conteúdo
document.getElementById('popupCadastro').addEventListener('click', function(e) {
    if (e.target === this) {
        fecharPopupCadastro();
    }
});

// Fechar popup com tecla ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        fecharPopupCadastro();
    }
});

//CPF fim