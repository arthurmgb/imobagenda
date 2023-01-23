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
            <a href="../proprietarios/proprietarios.php" class="nav-link active">
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
            <h1 class="m-0 text-dark">Novo Proprietário</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> <a href="">Proprietários</a> / Novo Proprietário</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
    <div class="container-fluid">
    <div class="row mb-3">
          <div class="col-12">
            <div class="d-flex">
              <a style="border-radius: 30px;" class="btn btn-lg btn-primary" href="proprietarios.php"><i class="fas fa-chevron-left mr-2"></i>Voltar</a>
            </div>
          </div>
        </div>
      <div class="row mt-3">
        <div class="col-12">
        <div class="card">
            <div class="card-body">
            <form action="add-prop.php" method="POST">
            <div class="form-row">
            <div class="form-group col-12">
                <label>Nome completo</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-6">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" >
            </div>           
            <div class="form-group col-6">
                <label>Profissão</label>
                <input type="text" name="profissao" class="form-control" required>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-4">
                <label>Bairro</label>
                <input type="text" name="bairro" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label>Endereço</label>
                <input type="text" name="endereco" class="form-control" required>
            </div>
            <div class="form-group col-2">
                <label>Número</label>
                <input type="number" name="numero" min="1" class="form-control" required>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-4">
                <label>Celular</label>
                <input data-mask="(00) 0 0000-0000" name="celular1" placeholder="(00) 9 0000-0000" type="text" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label>Celular 2</label>
                <input data-mask="(00) 0 0000-0000" name="celular2" placeholder="(00) 9 0000-0000" type="text" class="form-control">
            </div>         
            <div class="form-group col-4">
                <label>Telefone</label>
                <input type="text" name="telefone" class="form-control">
            </div>
            </div>
            <button type="submit" class="btn btn-lg btn-success float-right">Salvar</button>
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
