// Definições gerais
var base_url = "http://localhost/republicas/";

// VALIDAÇÕES PARA O LOGIN
$(function () {
  $("#form_login").submit(function (e) {
    var erro = 0;
    limpaValidacaoFormLogin();


    if (!isAlphaNum($("#user").val())) {
      $("#user").addClass('is-invalid');
      $("#user").attr('placeholder', "Nome de Usuário Inválido");
      $("#user").val('');
      e.preventDefault();
      return 0;
    }
    e.preventDefault();

    // Verifica credenciais
    var request = $.ajax({
      url: base_url+"credenciais/verifyCredentials",
      method: 'post',
      async: false,
      data: {
        'user': $('#user').val(),
        'senha': $('#senha').val()
      }
    });

    // Param: Reposta da verificação de credenciais (1 - OK, 2 - Usuário não existe, 3 - Senha incorreta)
    request.done(function (resposta) {
      if (resposta == 2) {
        $("#user").addClass("is-invalid");
        $("#user").attr("placeholder", "Usuário não encontrado");
        $("#user").val("");
        erro = 1;
      }
      else if (resposta == 3) {
        $("#senha").addClass("is-invalid");
        $("#senha").attr("placeholder", "Usuário incorreta");
        $("#senha").val("");
        erro = 1;
      }
    });

    request.fail(function () {
      alert("Estamos com problemas, tente novamente mais");
      e.preventDefault();
      erro = 1;
    });
    if (erro == 0) {
    }
    return false;
  })
});

function limpaValidacaoFormLogin () {
  $("#user").removeClass('is-invalid');
  $("#user").attr('placeholder', "Nome de Usuário");
  $("#senha").removeClass('is-invalid');
  $("#senha").attr('placeholder', "Senha");
}

// EXTRAS
function isAlphaNum(text){
  var alphaExp = /^[a-zA-Z-0-9]+$/;
  if(text.match(alphaExp)){
    return true;
  }else{
    return false;
  }
}