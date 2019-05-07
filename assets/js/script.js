// Definições gerais
var base_url = "http://localhost/QuartoHoteis/";
$('#cep').mask('00000-000');
$('#telefone').mask('(00) 00000-0000');
$('#hora_entrada').mask('00:00');
$('#hora_saida').mask('00:00');

// VALIDAÇÕES DO FORMULÁRIO DE CADASTRO
$("#form_cadastro").submit(function (e) {
  var erro = 0;
  limpaValidacaoFormCadastro();
  // Valida senha
  var senha = $("#senha");
  var senha2 = $("#senha2");
  if (temAspas($(senha).val()) || temAspas($(senha2).val())) {
    $('#label_senha').text("A senha não pode conter \"\'\"");
    $('#label_senha').addClass("text-danger");
    $(senha).val("");
    $(senha2).val(""); 
    $(senha).addClass("is-invalid");
    e.preventDefault();
    return false;
  }

  if ($(senha).val() != $(senha2).val()) {
    $('#label_senha').text("As senhas devem ser iguais");
    $('#label_senha').addClass("text-danger");
    $(senha).val("");
    $(senha2).val(""); 
    $(senha).addClass("is-invalid");
    e.preventDefault();
    return false;
  }

  // Verifica se o email não está em uso
  var request = $.ajax({
    url: base_url+"Credenciais/existEmail",
    method: 'post',
    async: false,
    data: {'email': $('#email').val()}
  });

  request.done(function (existe) {
    if (existe == 1) {
      $("#label_email").text("Este email já está cadastrado");
      $("#label_email").addClass("text-danger");
      $("#user").addClass("is-invalid");
      $("#user").val("");
      erro = 1;
    }
  });

  request.fail(function () {
    alert("Estamos com problemas, tente novamente mais");
    e.preventDefault();
    erro = 1;
  });
  if (erro == 1) {
    e.preventDefault();
    return false;
  }
});

// Para inserir a localização manualmente
function buscaCidades (estado_id) {
	var request = $.ajax({
		url: base_url+"Welcome/buscaCidades",
		data: {'estado_id': estado_id},
		method: "POST",
		dataType: 'json',
		async: false
	});

	request.done(function (cidades) {
		var select  = document.getElementById('cidade');
		$(select).empty();
    // Cria o elemento vazio
    var option = document.createElement("option");
    option.text = "Cidade";
    $(option).attr("value", "");
    $(option).addClass('text-black');
    select.add(option);   
		cidades.forEach(function (cidade) {
			var option = document.createElement("option");
			option.text = cidade.NomeCidade;
			$(option).attr("value", cidade.IDCidade);
      $(option).addClass('text-black');
			select.add(option);
		});
	});

  request.fail(function () {
    alert("Estamos com problemas, tente novamente mais tarde!");
    e.preventDefault();
  })
}

//Carregar o endereço automaticamente quando preenche o CEP
$("#cep").blur(function() {

  //Nova variável "cep" somente com dígitos.
  var cep = $(this).val().replace(/\D/g, '');

  //Expressão regular para validar o CEP.
  var validacep = /^[0-9]{8}$/;

  //Valida o formato do CEP.
  if(validacep.test(cep)) {
    //Preenche os campos com "..." enquanto consulta webservice.
    $("#rua").val("...");
    $("#bairro").val("...");

  // Selects de estado e cidade
  var cidade = document.getElementById('cidade');
  var estado = document.getElementById('estado');

    //Consulta o webservice viacep.com.br/
    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
      if (!("erro" in dados)) {
        //Atualiza os campos com os valores da consulta.
        $("#rua").val(dados.logradouro);
        $("#bairro").val(dados.bairro);
        $("#estado").val( $('option:contains('+dados.uf+')').val());
        var estado_id = $("#estado").val();
        buscaCidades(estado_id);
        $("#cidade").val( $('option:contains('+dados.localidade+')').val());
      } //end if.
      else {
        //CEP pesquisado não foi encontrado.
        alert("CEP não encontrado.");
      }
    });
  } //end if.
  else {
    //cep é inválido.
    alert("Formato de CEP inválido.");
  }
});

function limpaValidacaoFormCadastro () {
  // Limpa usuário
  $("#label_email").text("Email do Responsável");
  $("#label_email").removeClass("text-danger");
  $("#user").removeClass("is-invalid");

  // Limpa senha
  var senha = $("#senha");
  $('#label_senha').text("Senha");
  $('#label_senha').removeClass("text-danger");
  $(senha).removeClass("is-invalid");
}

function limpaValidacaoFormLogin () {
  $("#email").removeClass('is-invalid');
  $("#email").attr('placeholder', "Email Inválido");
  $("#senha").removeClass('is-invalid');
  $("#senha").attr('placeholder', "Senha");
}

// VISUALIZAÇÃO DE IMAGENS ANTES DO UPLOAD
// Show the selected image on input change
$("#input_0").on('change', function(){
  if (this.files && this.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      $('#tag_0').attr("src", e.target.result).fadeIn();
    }
    reader.readAsDataURL(this.files[0]);
  }
});

$("#input_1").on('change', function(){
  if (this.files && this.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      $('#tag_1').attr("src", e.target.result).fadeIn();
    }
    reader.readAsDataURL(this.files[0]);
  }
});

$("#input_2").on('change', function(){
  if (this.files && this.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      $('#tag_2').attr("src", e.target.result).fadeIn();
    }
    reader.readAsDataURL(this.files[0]);
  }
});

$("#input_3").on('change', function(){
  if (this.files && this.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      $('#tag_3').attr("src", e.target.result).fadeIn();
    }
    reader.readAsDataURL(this.files[0]);
  }
});

$("#input_4").on('change', function(){
  if (this.files && this.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      $('#tag_4').attr("src", e.target.result).fadeIn();
    }
    reader.readAsDataURL(this.files[0]);
  }
});

$("#input_5").on('change', function(){
  if (this.files && this.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      $('#tag_5').attr("src", e.target.result).fadeIn();
    }
    reader.readAsDataURL(this.files[0]);
  }
});

$("#logo").on('change', function(){
  if (this.files && this.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      $('#img_logo').attr("src", e.target.result).fadeIn();
    }
    reader.readAsDataURL(this.files[0]);
  }
});

$("#foto_capa").on('change', function(){
  if (this.files && this.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      $('#img_foto_capa').attr("src", e.target.result).fadeIn();
    }
    reader.readAsDataURL(this.files[0]);
  }
});

// FUNÇÕES DE RESERVA
// Faz a reserva
function reserva () {
  // Guarda variáveis
  let data_entrada = $("#data_entrada");
  let hora_entrada = $("#hora_entrada");
  let data_saida = $("#data_saida");
  let hora_saida = $("#hora_saida");
  let nome = $("#nome_reserva");
  let email = $("#email_reserva");
  let quantidade_pessoas = $("#quantidade_pessoas");

  limpaCamposReserva();

  if (validaCamposReserva()) {
    var request = $.ajax({
      url: base_url+"Quartos/reserva",
      method: 'post',
      data: {
        quarto_id: $("#quarto_id").val(),
        data_entrada: $(data_entrada).val(),
        hora_entrada: $(hora_entrada).val(),
        data_saida: $(data_saida).val(),
        hora_saida: $(hora_saida).val(),
        nome: $(nome).val(),
        email: $(email).val(),
        quantidade_pessoas: $(quantidade_pessoas).val()
      }
    });

    request.done((response) => {
      console.log(response);
      if (response == true) {
        $("#modal_reserva").modal('hide');
        $("#modal_confirmacao").modal('show');
      }
      else {
        alert('Algo deu errado, tente novamente');
        $("#modal_reserva").modal('hide');
      }
    });

    request.fail(() => {
      alert("Estamos com problemas, tente novamente mais tarde");
    });
  }
}

// Valida os campos
function validaCamposReserva () {
  // Guarda variáveis
  let data_entrada = $("#data_entrada");
  let hora_entrada = $("#hora_entrada");
  let data_saida = $("#data_saida");
  let hora_saida = $("#hora_saida");
  let nome = $("#nome_reserva");
  let email = $("#email_reserva");
  let quantidade_pessoas = $("#quantidade_pessoas");
  let validou = true;
  let hora = 0;
  let minuto = 0;

  // ṿalidações
  if ($(data_entrada).val() == '') {
    $(data_entrada).addClass('is-invalid');
    $(data_entrada).after(`<span class="text-danger">Este campo é obrigatório</span>`);
    validou = false;
  }

  if ($(hora_entrada).val() == '') {
    $(hora_entrada).addClass('is-invalid');
    $(hora_entrada).after(`<span class="text-danger">Este campo é obrigatório</span>`);
    validou = false;
  }
  else {
    hora = parseInt($(hora_entrada).val().substring(0, 2));
    minuto = parseInt($(hora_entrada).val().substring(3));
    if (hora > 23 || hora < 0 || minuto > 59 || minuto < 0) {
      $(hora_entrada).addClass('is-invalid');
      $(hora_entrada).after(`<span class="text-danger">Horário inválido</span>`);
      validou = false;
    }
  }

  if ($(data_saida).val() == '') {
    $(data_saida).addClass('is-invalid');
    $(data_saida).after(`<span class="text-danger">Este campo é obrigatório</span>`);
    validou = false;
  }

  if ($(hora_saida).val() == '') {
    $(hora_saida).addClass('is-invalid');
    $(hora_saida).after(`<span class="text-danger">Este campo é obrigatório</span>`);
    validou = false;
  }
  else {
    hora = parseInt($(hora_saida).val().substring(0, 2));
    minuto = parseInt($(hora_saida).val().substring(3));
    if (hora > 23 || hora < 0 || minuto > 59 || minuto < 0) {
      $(hora_saida).addClass('is-invalid');
      $(hora_saida).after(`<span class="text-danger">Horário inválido</span>`);
      validou = false;
    }
  }

  if ($(nome).val() == '') {
    $(nome).addClass('is-invalid');
    $(nome).after(`<span class="text-danger">Este campo é obrigatório</span>`);
    validou = false;
  }

  if ($(email).val() == '') {
    $(email).addClass('is-invalid');
    $(email).after(`<span class="text-danger">Este campo é obrigatório</span>`);
    validou = false;
  }

  if ($(quantidade_pessoas).val() == '') {
    $(quantidade_pessoas).addClass('is-invalid');
    $(quantidade_pessoas).after(`<span class="text-danger">Este campo é obrigatório</span>`);
    validou = false;
  }

  return validou;
}

// Limpa a validação
function limpaCamposReserva () {
  // Guarda variáveis
  let data_entrada = $("#data_entrada");
  let hora_entrada = $("#hora_entrada");
  let data_saida = $("#data_saida");
  let hora_saida = $("#hora_saida");
  let nome = $("#nome_reserva");
  let email = $("#email_reserva");
  let quantidade_pessoas = $("#quantidade_pessoas");

  $(data_entrada).removeClass('is-invalid');
  $(hora_entrada).removeClass('is-invalid');
  $(data_saida).removeClass('is-invalid');
  $(hora_saida).removeClass('is-invalid');
  $(nome).removeClass('is-invalid');
  $(email).removeClass('is-invalid');
  $(quantidade_pessoas).removeClass('is-invalid');

  $(data_entrada).next().remove();
  $(hora_entrada).next().remove();
  $(data_saida).next().remove();
  $(hora_saida).next().remove();
  $(nome).next().remove();
  $(email).next().remove();
  $(quantidade_pessoas).next().remove();
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

function temAspas (text) {
  if (text.indexOf('\'') > -1) {
    return true;
  }
  else {
    return false;
  }
}