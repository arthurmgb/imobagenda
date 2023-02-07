<?php require_once "../verify.php" ?>
<?php
require_once "../conexao.php";
?>
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
        <img src="../dist/img/agenda-icon.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">Agenda Sol & Lua</span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <?php require_once "../info-user.php" ?>
          <div class="image">
            <?php
            if ((isset($user_foto) and !empty($user_foto))) {
              echo "
              <img src='../registros/$user_id/$user_foto' class='img-circle elevation-2'>
              ";
            } else {
              echo "
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
              <a href="proprietarios.php" class="nav-link active">
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
              <h1 class="m-0 text-dark">Visualizar Proprietário</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="">Proprietários</a></li>
                <li class="breadcrumb-item active">Visualizar Proprietário</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <?php $id = filter_input(INPUT_GET, 'id',  FILTER_SANITIZE_NUMBER_INT); ?>
      <section class="content">
        <div class="container-fluid">
          <div class="row mb-3">

            <div class="col-12 d-flex flex-row flex-wrap align-items-center justify-content-between">
              <a style="border-radius: 30px;" class="btn btn-lg btn-primary my-1" href="proprietarios.php"><i class="fas fa-chevron-left mr-2"></i>Voltar</a>

              <a style="border-radius: 30px;" class="btn btn-warning btn-lg my-1" href="edit-prop.php?id=<?= $id ?>"><i class="fas fa-edit mr-2"></i>Editar</a>
            </div>

          </div>
          <div class="row">
            <div class="col-12">
              <?php
              if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
              }
              ?>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-agenda">
                  <h3 class="card-title"><i class="fas fa-user-tie mr-2"></i>Perfil do Proprietário</h3>
                </div>
                <div class="card-body">
                  <?php
                  $view_query = "SELECT * FROM proprietarios WHERE id='$id'";
                  $exec_view = mysqli_query($conn, $view_query);
                  $info = mysqli_fetch_assoc($exec_view);
                  ?>
                  <table class="table table-striped border">
                    <thead>
                    <tbody>
                      <tr>
                        <th scope="row">Nome completo</th>
                        <td><?= $info['nome'] ?></td>
                      </tr>
                      <tr>
                        <th scope="row">E-mail</th>
                        <td><?= $info['email'] ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Profissão</th>
                        <td><?= $info['profissao'] ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Bairro</th>
                        <td><?= $info['bairro'] ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Endereço</th>
                        <td><?= $info['endereco'] ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Número</th>
                        <td><?= $info['numero'] ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Celular</th>
                        <td><?= $info['celular1'] ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Celular 2</th>
                        <td><?= $info['celular2'] ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Telefone</th>
                        <td><?= $info['telefone'] ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Inquilinos</th>
                        <td>
                          <?php

                          //BUSCANDO ID INQUILINO
                          $get_inquilinos = "SELECT * FROM contatos WHERE id_prop='$id'";
                          $exec_get = mysqli_query($conn, $get_inquilinos);
                          while ($inq_id = mysqli_fetch_assoc($exec_get)) {
                            $ID_inquilino = $inq_id['id_inq'];

                            //BUSCANDO NOME DO INQUILINO
                            $get_inq_name = "SELECT * FROM inquilinos WHERE id='$ID_inquilino'";
                            $exec_inq_name = mysqli_query($conn, $get_inq_name);

                            while ($inquilino = mysqli_fetch_assoc($exec_inq_name)) {
                              echo "
                      <a href='../inquilinos/view-inquilinos.php?id={$inquilino['id']}'>{$inquilino['nome']}</a>
                      <br>";
                            }
                          }
                          ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer text-muted pb-0">

                </div>
              </div>
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
</body>

</html>