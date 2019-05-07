<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <!-- Bootstrap  -->
  <link rel="stylesheet" href="<?= base_url('assets/template/css/bootstrap.css') ?>">
  <!--Bootsrap 4 CDN-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <!--Custom styles-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/login_style.css') ?>">
</head>
<body>
<div class="container">
  <div class="d-flex justify-content-center h-100">
    <div class="card">
      <div class="card-header">
        <h1 class="text-white">Login</h1>
      </div>
      <div class="card-body align-middle">
        <form action="<?= base_url('login') ?>" method="post" name="form_login" id="form_login">
          <div class="input-group form-group">
            <div class="input-group-prepend mt-5">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" name="email" id="email" class="form-control mt-5 font-maior <?= isset($invalid_email) ? 'is-invalid':'' ?>" placeholder="<?= isset($invalid_email) ? 'Email Não Encontrado':'Email' ?>" required maxlength="20">
          </div>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" name="senha" id="senha" class="form-control font-maior <?= isset($wrong_password) ? 'is-invalid':'' ?>" placeholder="<?= isset($wrong_password) ? 'Senha Inválida':'Senha' ?>" required minlength="8" maxlength="50">
          </div>
          <div class="form-group text-center">
            <input type="submit" value="Entrar" class="btn login_btn">
          </div>
          <div class="card-footer">
            <div class="d-flex justify-content-center links">
              Não tem conta?<a href="<?= base_url('cadastrar') ?>">Cadastre-se</a>
            </div>
            <div class="d-flex justify-content-center links">
              <a href="<?= base_url() ?>">Retornar a página inicial</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="<?= base_url('assets/template/js/jquery.min.js') ?>"></script>
<!-- Bootstrap -->
<script src="<?= base_url('assets/template/js/bootstrap.min.js') ?>"></script>
<!-- Mascara da Jquery -->
<script src="<?= base_url('assets/jquery_mask/jquery.mask.min.js') ?>"></script>
<!-- Script -->
<script src="<?= base_url('assets/js/script.js') ?>"></script>

</body>
</html>