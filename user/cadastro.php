<?php require_once "../verify.php" ?>
<?php require_once "../conexao.php"?>
<!DOCTYPE html>
<html>
<head>
  <?php require_once "../head.php" ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php require_once "../navbar.php" ?>
  <!-- /.navbar -->

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="../painel/index.php" class="brand-link">
      <img src="../dist/img/agenda-icon.png" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Agenda Sol & Lua</span>
    </a>

    <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <?php require_once "../info-user.php" ?>
        <div class="image">
          <?php 
            if((isset($user_foto) AND !empty($user_foto))){
              echo"
              <img src='../registros/$user_id/$user_foto' class='img-circle elevation-2'>
              ";
            }else{
              echo"
              <img src='../dist/img/avatar5.png' class='img-circle elevation-2'>
              ";
            }
          ?>         
        </div>
        <div class="info">
          <a href="../painel/conta.php" class="d-block"><?= $user_name ?></a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item my-1">
            <a href="../painel/index.php" class="nav-link">
            <i class="fas fa-chart-bar nav-icon"></i>
              <p>
                Painel
              </p>
            </a>
          </li>
          <li class="nav-item my-1">
            <a href="../contatos/contatos.php" class="nav-link">
            <i class="fas fa-clipboard-list nav-icon"></i>
              <p>
                Contatos
              </p>
            </a>
          </li>
          <li class="nav-item my-1">
            <a href="../proprietarios/proprietarios.php" class="nav-link">
              <i class="fas fa-user-tie nav-icon"></i>
              <p>
                Proprietários
              </p>
            </a>
          </li>
          <li class="nav-item my-1">
            <a href="../inquilinos/inquilinos.php" class="nav-link">
              <i class="fas fa-user-friends nav-icon"></i>
              <p>
                Inquilinos
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Criar novo usuário</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> <a href="">Painel</a> / Conta / Novo usuário</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
    <div class="container-fluid">
    <div class="row mb-3">
          <div class="col-6">
            <div class="d-flex">
              <a style="border-radius: 30px;" class="btn btn-lg btn-primary" href="../painel/conta.php"><i class="fas fa-chevron-left mr-2"></i>Voltar</a>              
            </div>
          </div>
    </div>
    <div class="row">
        <div class="col-12">
          <?php 
            if(isset($_SESSION['msg'])){
              echo $_SESSION['msg'];
              unset($_SESSION['msg']);
            }
          ?>
        </div>
    </div>
      <div class="row mt-3">
        <div class="col-12">
        <div class="card">
            <div class="card-body">
            <form action="new-user.php" method="POST">
            <div class="form-row">
            <div class="form-group col-12">
                <label>Nome completo</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-6">
                <label>Usuário</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>           
            <div class="form-group col-6">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>
            </div>          
            <button type="submit" class="btn btn-lg btn-primary float-right">Cadastrar</button>
            </form>
            </div>
            </div>
        </div>
      </div>
      </div>
    </section>

  </div>
  <!-- Footer -->
  <?php require_once "../footer.php" ?>
  <!-- Footer -->
</div>
<!-- Scripts -->
  <?php require_once "../scripts.php" ?>
<!-- Scripts -->
<!-- Data Mask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous"></script>
</body>
</html>
