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
        <div class="row">
          <div class="col-12">
             
              <div class="card bg-gradient-success">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="far fa-calendar-alt mr-1"></i>
                    Calendário
                  </h3>
                </div>
                <div class="card-body pt-0">
                  <div id="calendar" style="min-height: 250px; height: 250px; max-height: 250px; width: 100%;"></div>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card" id="tasks">
              <div class="card-header bg-primary">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Lista de tarefas
                </h3>
              </div>
              <div class="card-body pb-2">
                <ul class="todo-list" data-widget="todo-list">
                <?php
                  $select_tarefas = "SELECT * FROM tarefas";
                  $exec_tarefas = mysqli_query($conn, $select_tarefas);
                  $num_task = mysqli_num_rows($exec_tarefas);
                ?>
                <?php while($tarefa = mysqli_fetch_assoc($exec_tarefas)): 

                  $id_tarefa = $tarefa['id'];
                  $nome_tarefa = $tarefa['nome'];
                  $data = $tarefa['criado']; 
                  $hora = $tarefa['criado']; 
                  $checked = $tarefa['checked'];

                  //Format datas

                  $format_data = date('d/m', strtotime($data));
                  $format_hora = date('H:i', strtotime($hora));

                ?>
                  <?php if($checked == 0): ?>
                  <li class="li-borda mb-2">
                    <div class="icheck-primary d-inline ml-2">
                      <input onchange='window.location.assign("check_task.php?id=<?= $id_tarefa?>")' type="checkbox" value="" name="todo1" id="todoCheck<?= $id_tarefa ?>">
                      <label for="todoCheck<?= $id_tarefa ?>"></label>
                    </div>
                    <span class="text"><?= $nome_tarefa ?></span>
                    <small class="badge badge-success"><i class="far fa-calendar-alt mr-1"></i><?= $format_data ?></small>
                    <small class="badge badge-primary"><i class="far fa-clock mr-1"></i><?= $format_hora ?></small>
                    <div class="tools">
                      <i data-toggle="modal" data-target="#edittask<?= $id_tarefa ?>" style="color: #007BFF;" class="fas fa-edit todo-icon"></i>
                      <i data-toggle="modal" data-target="#removetask<?= $id_tarefa ?>" class="fas fa-trash todo-icon"></i>
                    </div>
                  </li>
                  <!-- Apagar tarefa -->
                  <div class="modal fade" id="removetask<?= $id_tarefa ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header bg-danger">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash mr-2"></i>Apagar tarefa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <i class="fas fa-times-circle text-white"></i>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h5 class="mb-0">Deseja realmente apagar essa tarefa?</h5>
                      </div>
                      <div style="background-color: #f7f7f7" class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <a href="delete-task.php?id=<?= $id_tarefa ?>" class="btn btn-danger">Apagar</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Apagar tarefa -->
                <!-- Editar tarefa -->
                <div class="modal fade" id="edittask<?= $id_tarefa ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit mr-2"></i>Editar tarefa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <i class="fas fa-times-circle text-white"></i>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form action="edit_task.php" method="POST">
                      <div class="form-group mb-0">
                        <label class="h6 ml-1">Nome da tarefa</label>
                        <input type="hidden" name="id" value="<?= $id_tarefa ?>">
                        <input name="edit" type="text" class="form-control" value="<?= $nome_tarefa ?>" required>
                      </div>
                      </div>
                      <div style="background-color: #f7f7f7" class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success">Salvar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Editar tarefa -->
                  <?php endif ?>
                  <?php if($checked == 1): ?>
                    <li class="li-borda mb-2">
                    <div class="icheck-primary d-inline ml-2">
                      <input onchange='window.location.assign("uncheck_task.php?id=<?= $id_tarefa?>")' type="checkbox" value="" name="todo1" id="todoCheck<?= $id_tarefa ?>" checked> 
                      <label for="todoCheck<?= $id_tarefa ?>"></label>
                    </div>
                    <span class="text"><?= $nome_tarefa ?></span>
                    <small class="badge badge-success"><i class="far fa-calendar-alt mr-1"></i><?= $format_data ?></small>
                    <small class="badge badge-primary"><i class="far fa-clock mr-1"></i><?= $format_hora ?></small>
                    <div class="tools">
                      <i data-toggle="modal" data-target="#edittask<?= $id_tarefa ?>" style="color: #007BFF;" class="fas fa-edit todo-icon"></i>
                      <i data-toggle="modal" data-target="#removetask<?= $id_tarefa ?>" class="fas fa-trash todo-icon"></i>
                    </div>
                  </li>
                  <!-- Apagar tarefa -->
                  <div class="modal fade" id="removetask<?= $id_tarefa ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header bg-danger">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash mr-2"></i>Apagar tarefa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <i class="fas fa-times-circle text-white"></i>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h5 class="mb-0">Deseja realmente apagar essa tarefa?</h5>
                      </div>
                      <div style="background-color: #f7f7f7" class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <a href="delete-task.php?id=<?= $id_tarefa ?>" class="btn btn-danger">Apagar</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Apagar tarefa -->
                <!-- Editar tarefa -->
                <div class="modal fade" id="edittask<?= $id_tarefa ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit mr-2"></i>Editar tarefa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <i class="fas fa-times-circle text-white"></i>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form action="edit_task.php" method="POST">
                      <div class="form-group mb-0">
                        <label class="h6 ml-1">Nome da tarefa</label>
                        <input type="hidden" name="id" value="<?= $id_tarefa ?>">
                        <input name="edit" type="text" class="form-control" value="<?= $nome_tarefa ?>" required>
                      </div>
                      </div>
                      <div style="background-color: #f7f7f7" class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success">Salvar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Editar tarefa -->
                  <?php endif ?>
                <?php endwhile ?>
                <?php if($num_task === 0): ?>
                  <div class="alert alert-light" role="alert">
                    Nenhuma tarefa foi adicionada!
                  </div>
                  <?php endif ?>
                </ul>
              </div>
              <div class="card-footer clearfix">
                <?php 
                  $pendentes = "SELECT COUNT(checked) AS checado FROM tarefas WHERE checked='0'";
                  $exec_pendentes = mysqli_query($conn, $pendentes);
                  $restante = mysqli_fetch_assoc($exec_pendentes);
                ?>
              
                <span class="badge pendentes badge-warning mt-2"><?= $restante['checado'] ?> tarefas pendentes</span>
                <button style="border-radius: 60px;" data-toggle="modal" data-target="#addtask" type="button" class="btn btn-success float-right"><i class="fas fa-plus"></i> Nova tarefa</button>
              </div>
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
