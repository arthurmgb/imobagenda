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
              <a href="../contatos/contatos.php" class="nav-link active">
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
              <h1 class="m-0 text-dark">Visualizar Contato</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="">Contatos</a></li>
                <li class="breadcrumb-item active">Visualizar Contato</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <?php
      $contato = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      $busca_contato = "SELECT * FROM contatos WHERE id='$contato'";
      $exec_busca = mysqli_query($conn, $busca_contato);
      ?>
      <section class="content">
        <div class="container-fluid">
          <div class="row mb-3">

            <div class="col-12 d-flex flex-wrap flex-row align-items-center justify-content-between">
              <a style="border-radius: 30px;" class="btn btn-lg btn-primary my-1" href="contatos.php"><i class="fas fa-chevron-left mr-2"></i>Voltar</a>

              <a style="border-radius: 30px;" class="btn btn-warning btn-lg my-1" href="edit-contato.php?id=<?= $contato ?>"><i class="fas fa-edit mr-2"></i>Editar contato</a>
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
            <?php
            $info = mysqli_fetch_assoc($exec_busca);

            $prop = $info['id_prop'];
            $inq =  $info['id_inq'];

            //BUSCANDO PROP

            $busca_prop = "SELECT * FROM proprietarios WHERE id='$prop'";
            $exec_prop = mysqli_query($conn, $busca_prop);
            $info_prop = mysqli_fetch_assoc($exec_prop);

            //BUSACANDO INQ

            $busca_inq = "SELECT * FROM inquilinos WHERE id='$inq'";
            $exec_inq = mysqli_query($conn, $busca_inq);
            $info_inq = mysqli_fetch_assoc($exec_inq);

            ?>
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-agenda">
                  <h3 class="card-title"><i class="fas fa-clipboard-list mr-2"></i>Detalhes do Contato</h3>
                </div>
                <div class="card-body">
                  <table class="table table-striped border">
                    <thead class="text-center">
                      <tr>
                        <th class="text-primary border-right" scope="col">Proprietário</th>
                        <th class="text-success border-right" scope="col">Inquilino</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Nome completo: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_prop['nome'] ?></div>
                        </th>
                        <th scope="row">Nome completo: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_inq['nome'] ?></div>
                        </th>
                      </tr>
                      <tr>
                        <th scope="row">E-mail: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_prop['email'] ?></div>
                        </th>
                        <th scope="row">E-mail: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_inq['email'] ?></div>
                        </th>
                      </tr>
                      <tr>
                        <th scope="row">Profissão: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_prop['profissao'] ?></div>
                        </th>
                        <th scope="row">Profissão: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_inq['profissao'] ?></div>
                        </th>
                      </tr>
                      <tr>
                        <th scope="row">Bairro: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_prop['bairro'] ?></div>
                        </th>
                        <th scope="row">Bairro: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_inq['bairro'] ?></div>
                        </th>
                      </tr>
                      <tr>
                        <th scope="row">Endereço: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_prop['endereco'] ?></div>
                        </th>
                        <th scope="row">Endereço: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_inq['endereco'] ?></div>
                        </th>
                      </tr>
                      <tr>
                        <th scope="row">Número: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_prop['numero'] ?></div>
                        </th>
                        <th scope="row">Número: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_inq['numero'] ?></div>
                        </th>
                      </tr>
                      <tr>
                        <th scope="row">Celular: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_prop['celular1'] ?></div>
                        </th>
                        <th scope="row">Celular: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_inq['celular'] ?></div>
                        </th>
                      </tr>
                      <tr>
                        <th scope="row">Celular 2: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_prop['celular2'] ?></div>
                        </th>
                        <th scope="row">Celular 2: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_inq['celular2'] ?></div>
                        </th>
                      </tr>
                      <tr>
                        <th scope="row">Telefone: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_prop['telefone'] ?></div>
                        </th>
                        <th scope="row">Telefone: <div class="font-weight-normal d-inline-flex ml-1"><?= $info_inq['telefone'] ?></div>
                        </th>
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