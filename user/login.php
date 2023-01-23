<?php require_once "../conexao.php" ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "../head.php" ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="../dist/img/logo_log.png" alt="Sol & Lua Imobiliária">
  </div>
  <!-- /.login-logo -->
  <div class="card card-log">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Faça login para acessar o painel</p>
      <?php 
        if(isset($_SESSION['msg'])){
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
        }
      ?>
      <form action="try-login.php" method="POST">
        <div class="input-group border-login mb-3">
          <input type="text" name="usuario" class="form-control no-border" placeholder="Usuário" required>
          <div class="input-group-append">
            <div class="input-group-text no-border">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group border-login mb-3">
          <input type="password" name="senha" class="form-control no-border" placeholder="Senha" required>
          <div class="input-group-append">
            <div class="input-group-text no-border">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block">Acessar<i class="fas fa-sign-in-alt ml-2"></i></button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- Scripts -->
<?php require_once "../scripts.php" ?>
<!-- Scripts -->

</body>
</html>
