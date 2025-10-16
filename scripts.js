// Mostrar Senha Para Limpar TUDO

const password = "10101993"

var limparTudo = function(){
    var digitado = prompt ('Digite a senha de acesso');
   if(digitado == password){


    $.post('limpatudo_painel.php', {}, function(result) {
        if(result == "OK"){
            alert ("Resetado com sucesso");
        }else{
            alert("Erro ao resetar");
        }
      });


   }else{
alert(' Senha Incorreta');
   }
}

const password2 = "10101993";

var limparleitor = function(i_ip) {
    var digitado = prompt('Digite a senha de acesso');
    if (digitado == password) {
        $.post('limpaleitor.php', {
            qip: i_ip
        }, function(result) {
            if (result == "OK") {
                alert("Leitor limpo com sucesso");
            } else {
                alert("Erro ao limpar leitor");
            }
        });
    } else {
        alert('Senha Incorreta');
    }
}


var selecionarEvento = function () {
  $.post('check_leitores_devices.php', function (chk) {
    chk = (typeof chk === 'string') ? chk.trim() : '';
    if (chk === 'ok') {
      var idDoEvento = prompt('Digite o ID do evento');
      if (idDoEvento != 0 && idDoEvento !== "") {
        $.post('get_evento.php', { qevento: idDoEvento }, function (result_sev) {
          if (result_sev === 'erro') {
            alert('erro ao pegar dados do evento');
          } else {
            $("#nomeev").html(result_sev);
            localStorage.setItem('nomeev', result_sev);
          }
        });
      } else {
        alert("Você não digitou um evento válido");
      }
    } else {
      var msg = chk.replace(/^erro\|?/, '');
      alert("Não é possível selecionar o evento.\n" + (msg || "Existem leitores sem device_1/device_2."));
    }
  }).fail(function () {
    alert('Falha ao verificar leitores.');
  });
};


var mostrarEvento = function() {
    // Recuperar o nome do evento do Local Storage
    var nomeEvArmazenado = localStorage.getItem('nomeev');
    if (nomeEvArmazenado) {
        $("#nomeev").html(nomeEvArmazenado);
    }
}

// Mostrar a informação armazenada ao carregar a página
document.addEventListener('DOMContentLoaded', mostrarEvento);

 var logout = function() {
 // Limpar o Local Storage ao fazer logout
     localStorage.removeItem('nomeev')
     // Redirecionar para o script de logout em PHP
     window.location.href = 'logout.php';
  }




 



