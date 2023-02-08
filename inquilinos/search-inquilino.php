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
              <a href="../proprietarios/proprietarios.php" class="nav-link">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>
                  Proprietários
                </p>
              </a>
            </li>
            <li class="nav-item my-1">
              <a href="inquilinos.php" class="nav-link active">
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
              <h1 class="m-0 text-dark">Inquilinos</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Inquilinos</li>
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
                <?php
                $get_param = filter_input(INPUT_GET, 'pesquisar', FILTER_SANITIZE_STRING);
                ?>
                <form action="search-inquilino.php" method="GET" class="flex-fill">

                  <div class="mb-0 d-flex flex-row align-items-center">
                    <input type="text" name="pesquisar" class="form-control search-form flex-fill" placeholder="Pesquisar..." value="<?= $get_param ?>" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">

                    <button onclick="this.form.pesquisar.value=this.form.pesquisar.value.trim()" class="btn btn-edit pl-0 mr-2" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>

                </form>

                <a style="border-radius: 30px;" class="btn btn-lg btn-success mt-2 ml-auto" href="new-inquilino.php"><i class="fas fa-plus-circle mr-2"></i>
                  Novo inquilino
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
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header bg-agenda">
                      <h3 class="card-title"><i class="fas fa-user-friends nav-icon mr-2"></i>Lista de inquilinos</h3>
                    </div>
                    <div class="card-body table-responsive">
                      <table class="table table-striped text-center">
                        <thead>
                          <tr>
                            <th scope="col" width="120">Nome</th>
                            <th scope="col" width="120">Celular</th>
                            <th scope="col" width="100">Celular 2</th>
                            <th scope="col" width="120">Telefone</th>
                            <th scope="col" width="100">Ações</th>
                          </tr>
                        </thead>
                        <?php
                        $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                        $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                        $qtd_result = 10;
                        $start = ($qtd_result * $pagina) - $qtd_result;

                        $valor_pesquisa = $_GET['pesquisar'];
                        $voltar_inquilino = "SELECT * FROM inquilinos WHERE nome LIKE '%$valor_pesquisa%' ORDER BY nome LIMIT $start, $qtd_result";
                        $voltar_inquilino_query = mysqli_query($conn, $voltar_inquilino);
                        $reg_inquilino = mysqli_num_rows($voltar_inquilino_query)
                        ?>
                        <tbody>
                          <?php while ($row_inquilino = mysqli_fetch_assoc($voltar_inquilino_query)) :
                            $id_inquilino = $row_inquilino['id'];
                            $nome_inquilino = $row_inquilino['nome'];
                            $celular_inquilino = $row_inquilino['celular'];
                            $celular_inquilino2 = $row_inquilino['celular2'];
                            $telefone_inquilino = $row_inquilino['telefone'];
                          ?>
                            <tr>                       
                              <td><?= $nome_inquilino ?></td>
                              <td><?= $celular_inquilino ?></td>
                              <td><?= $celular_inquilino2 ?></td>
                              <td><?= $telefone_inquilino ?></td>
                              <td>
                                <a class="btn btn-sm btn btn-primary mx-1" style="border-radius: 60px" href="view-inquilinos.php?id=<?= $id_inquilino ?>" title="visualizar"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn btn-warning mx-1" style="border-radius: 60px" href="edit-inquilinos.php?id=<?= $id_inquilino ?>"><i class="fas fa-edit" title="editar"></i></a>
                                <a class="btn btn-sm btn btn-danger mx-1" data-toggle="modal" data-target="#removeinquil<?= $id_inquilino ?>" style="border-radius: 60px" href="" title="apagar"><i class="fas fa-trash"></i></a>
                              </td>
                            </tr>
                            <!-- Apagar inquilino -->
                            <div class="modal fade" id="removeinquil<?= $id_inquilino ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header bg-danger">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash mr-2"></i>Apagar inquilino</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fas fa-times-circle text-white"></i>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <h5 class="mb-0">Deseja realmente apagar esse inquilino?</h5>
                                  </div>
                                  <div style="background-color: #f7f7f7" class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <a href="delete-inquili.php?id=<?= $id_inquilino ?>" class="btn btn-danger">Apagar</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- fim Apagar inquilino -->
                          <?php endwhile ?>
                          <?php
                          $result_pg = "SELECT COUNT(id) AS num_result FROM inquilinos";
                          $resultado_pg = mysqli_query($conn, $result_pg);
                          $row_pg = mysqli_fetch_assoc($resultado_pg);
                          $quantidade_pg = ceil($row_pg['num_result'] / $qtd_result);
                          $max_links = 1;
                          ?>
                        </tbody>
                      </table>
                      <?php if ($reg_inquilino == 0) : ?>
                        <div style="border-bottom: 2px solid #ccc;" class="alert alert-light alert-hover" role="alert">
                          Nenhum inquilino encontrado.
                        </div>
                      <?php endif ?>
                    </div>
                    <div class="card-footer text-muted pb-0">
                      <div class="float-right">
                        <nav aria-label="Page navigation example">
                          <ul class="pagination">
                            <li title="Primeira" class="page-item">
                              <a class="page-link" href="inquilinos.php?pagina=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <?php for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) : ?>
                              <?php if ($pag_ant >= 1) : ?>
                                <li class="page-item"><a class="page-link" href="inquilinos.php?pagina=<?= $pag_ant ?>"><?= $pag_ant ?></a></li>
                              <?php endif ?>
                            <?php endfor ?>
                            <li class="page-item"><a class="page-link"><?= $pagina ?></a></li>
                            <?php for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) : ?>
                              <?php if ($pag_dep <= $quantidade_pg) : ?>
                                <li class="page-item"><a class="page-link" href="inquilinos.php?pagina=<?= $pag_dep ?>"><?= $pag_dep ?></a></li>
                              <?php endif ?>
                            <?php endfor ?>

                            <li title="Última" class="page-item">
                              <a class="page-link" href="inquilinos.php?pagina=<?= $quantidade_pg ?>" aria-label="Next">
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