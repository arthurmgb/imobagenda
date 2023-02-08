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
              <h1 class="m-0 text-dark">Proprietários</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Proprietários</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-12">
              <div class="d-flex flex-row flex-wrap align-items-center mb-1">

                <form action="search-prop.php" method="GET" class="flex-fill">

                  <div class="mb-0 d-flex flex-row align-items-center">
                    <input type="text" name="pesquisar" class="form-control search-form flex-fill" placeholder="Pesquisar...">

                    <button onclick="this.form.pesquisar.value=this.form.pesquisar.value.trim()" class="btn btn-edit pl-0 mr-2" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>

                </form>

                <a style="border-radius: 30px;" class="btn btn-lg btn-success mt-2 ml-auto" href="new-proprietario.php"><i class="fas fa-plus-circle mr-2"></i>
                  Novo proprietário
                </a>

              </div>
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
                  <h3 class="card-title"><i class="fas fa-user-tie mr-2"></i>Lista de Proprietários</h3>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-striped text-center border">
                    <thead>
                      <tr>
                        <th scope="col" width="120">Nome</th>
                        <th scope="col" width="120">Celular</th>
                        <th scope="col" width="100">Celular 2</th>
                        <th scope="col" width="120">Telefone</th>
                        <th scope="col" width="100">Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php



                      $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                      $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                      $qtd_result = 10;
                      $start = ($qtd_result * $pagina) - $qtd_result;

                      $select_props = "SELECT * FROM proprietarios ORDER BY nome ASC LIMIT $start, $qtd_result";
                      $exec_props = mysqli_query($conn, $select_props);
                      $reg_props = mysqli_num_rows($exec_props);
                      ?>
                      <?php while ($row_prop = mysqli_fetch_assoc($exec_props)) :
                        $props_id = $row_prop['id'];
                        $props_nome = $row_prop['nome'];
                        $props_celular = $row_prop['celular1'];
                        $props_celular2 = $row_prop['celular2'];
                        $props_telefone = $row_prop['telefone'];
                      ?>
                        <tr>
                          <td><?= $props_nome ?></td>
                          <td><?= $props_celular ?></td>
                          <td><?= $props_celular2 ?></td>
                          <td><?= $props_telefone ?></td>
                          <td>
                            <a title="Visualizar" style="border-radius: 60px;" class="btn btn-primary btn-sm mx-1" href="view-prop.php?id=<?= $props_id ?>"><i class="fas fa-eye"></i></a>
                            <a title="Editar" style="border-radius: 60px;" class="btn btn-warning btn-sm mx-1" href="edit-prop.php?id=<?= $props_id ?>"><i class="fas fa-edit"></i></a>
                            <a title="Apagar" data-toggle="modal" data-target="#removeprop<?= $props_id ?>" style="border-radius: 60px;" class="btn btn-danger btn-sm mx-1" href=""><i class="fas fa-trash"></i></a>
                          </td>
                        </tr>
                        <!-- Apagar proprietário -->
                        <div class="modal fade" id="removeprop<?= $props_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash mr-2"></i>Apagar proprietário</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <i class="fas fa-times-circle text-white"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h5 class="mb-0">Deseja realmente apagar esse proprietário?</h5>
                              </div>
                              <div style="background-color: #f7f7f7" class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <a href="delete-prop.php?id=<?= $props_id ?>" class="btn btn-danger">Apagar</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Apagar proprietário -->
                      <?php endwhile ?>
                      <?php
                      $result_pg = "SELECT COUNT(id) AS num_result FROM proprietarios";
                      $resultado_pg = mysqli_query($conn, $result_pg);
                      $row_pg = mysqli_fetch_assoc($resultado_pg);
                      $quantidade_pg = ceil($row_pg['num_result'] / $qtd_result);
                      $max_links = 1;
                      ?>
                    </tbody>
                  </table>
                  <?php if ($reg_props === 0) : ?>
                    <div style="border-bottom: 2px solid #ccc;" class="alert alert-light alert-hover" role="alert">
                      Nenhum proprietário cadastrado.
                    </div>
                  <?php endif ?>
                </div>
                <div class="card-footer text-muted pb-0">
                  <div class="float-right">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <li title="Primeira" class="page-item">
                          <a class="page-link" href="proprietarios.php?pagina=1" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                        <?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) : ?>
                          <?php if ($pag_ant >= 1) : ?>
                            <li class="page-item"><a class="page-link" href="proprietarios.php?pagina=<?= $pag_ant ?>"><?= $pag_ant ?></a></li>
                          <?php endif ?>
                        <?php endfor ?>
                        <li class="page-item"><a class="page-link"><?= $pagina ?></a></li>
                        <?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) : ?>
                          <?php if ($pag_dep <= $quantidade_pg) : ?>
                            <li class="page-item"><a class="page-link" href="proprietarios.php?pagina=<?= $pag_dep ?>"><?= $pag_dep ?></a></li>
                          <?php endif ?>
                        <?php endfor ?>

                        <li title="Última" class="page-item">
                          <a class="page-link" href="proprietarios.php?pagina=<?= $quantidade_pg ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      </ul>
                    </nav>
                  </div>
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