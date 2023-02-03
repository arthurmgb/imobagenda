<?php require_once "../verify.php" ?>
<?php require_once "../conexao.php" ?>
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
    <a href="index.php" class="brand-link">
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
            <a href="index.php" class="nav-link active">
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
            <h1 class="m-0 text-dark">Painel</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Painel</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <div class="inner">
              <?php
               $contagemContatos = "SELECT COUNT(id) AS total_contatos FROM contatos";
               $contatos_query = mysqli_query($conn, $contagemContatos);
               $result_contatos = mysqli_fetch_assoc($contatos_query);
              ?>
                <h3><?= $result_contatos['total_contatos'] ?></h3>

                <p>Contatos</p>
              </div>
              <div class="icon">
                <i class="fas fa-clipboard-list"></i>
              </div>
              <a href="../contatos/contatos.php" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
              <div class="inner">
              <?php
               $contagemProps = "SELECT COUNT(id) AS total_props FROM proprietarios";
               $props_query = mysqli_query($conn, $contagemProps);
               $result_props = mysqli_fetch_assoc($props_query);
              ?>
                <h3><?= $result_props['total_props'] ?></h3>

                <p>Proprietários</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
              <a href="../proprietarios/proprietarios.php" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
              <?php
               $contagemInq = "SELECT COUNT(id) AS total_inq FROM inquilinos";
               $inq_query = mysqli_query($conn, $contagemInq);
               $result_inq = mysqli_fetch_assoc($inq_query);
              ?>
                <h3><?= $result_inq['total_inq'] ?></h3>

                <p>Inquilinos</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-friends"></i>
              </div>
              <a href="../inquilinos/inquilinos.php" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<!-- Modal -->
<div class="modal fade" id="addtask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-tasks mr-2"></i>Adicionar tarefa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times-circle text-white"></i>
        </button>
      </div>
      <div class="modal-body">
      <form action="add_task.php" method="POST">
        <div class="form-group mb-0">
          <label class="h6 ml-1">Nome da tarefa</label>
          <input name="task" type="text" class="form-control" placeholder="Digite sua tarefa..." required>
        </div>     
      </div>
      <div style="background-color: #f7f7f7" class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-plus mr-1"></i>Adicionar</button>
        </form>
      </div>
    </div>
  </div>
</div>

  <!-- Footer -->
  <?php require_once "../footer.php" ?>
  <!-- Footer -->

</div>


<!-- Scripts -->
  <?php require_once "../scripts.php" ?>
<!-- Scripts -->

<script>
    // The Calender
    $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })
</script>
</body>
</html>
