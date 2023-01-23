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
            <a href="contatos.php" class="nav-link active">
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
            <h1 class="m-0 text-dark">Novo Contato</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Contatos</a></li>
              <li class="breadcrumb-item active">Novo Contato</li>
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
              <a style="border-radius: 30px;" class="btn btn-lg btn-primary" href="contatos.php"><i class="fas fa-chevron-left mr-2"></i>Voltar</a>
            </div>
          </div>
        </div>
        <div class="row">
        <?php $contato = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); ?>
          <div class="col-12">
          <div class="card">
            <div class="card-body">
            <form action="editar-contato.php" method="POST">
            <input type="hidden" value="<?= $contato ?>" name="contato">
            <div class="form-row">
            <div class="form-group col-12">
              <label>Selecione um novo Inquilino</label>
              <button data-toggle="modal" data-target="#inquilino" type="button" class="btn btn-block btn-lg btn-success"><i class="fas fa-user-plus mr-2"></i>Selecionar novo Inquilino</button>
            </div>
            </div>
            <!-- Modal Inquilino -->
  <div class="modal fade" id="inquilino" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-user-friends mr-2"></i>Selecione um novo Inquilino</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times-circle text-white"></i>
        </button>
      </div>
      <div class="modal-body">
      <table id="inq_table" class="table table-striped text-center border mb-0">
                  <thead>
                    <tr>
                      <th><i class="fas fa-user-plus"></i></th>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Celular</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                   $select_inq = "SELECT * FROM inquilinos ORDER BY nome";
                   $query_inq = mysqli_query($conn, $select_inq);                  
                  ?>
                  <?php while($inq = mysqli_fetch_assoc($query_inq)): ?>
                    <tr>
                      <td>
                        <input type="radio" value="<?= $inq['id'] ?>" name="inq">
                      </td>
                      <td><?= $inq['nome'] ?></td>
                      <td><?= $inq['email'] ?></td>
                      <td><?= $inq['celular'] ?></td>
                    </tr>           
                  <?php endwhile ?>         
                  </tbody>
        </table>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" data-dismiss="modal" id="show_inq" class="btn btn-success"><i class="fas fa-plus mr-1"></i>Adicionar</button>
      </div>
    </div>
  </div>
</div>
  <!-- Modal Inquilino -->
            <div id="bloco2" class="card mt-2 d-none" style="width: 18rem; border-top: 2px solid #28A745;">
                <div id="selec_inq" class="card-body text-center"></div>
            </div>
            <button style="border-radius: 60px;" type="submit" class="btn btn-lg btn-success float-right"><i class="fas fa-save mr-2"></i>Salvar contato</button>

          </form>
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
<script>

$('#selectall').click(function(event) {
  $(':radio').prop('checked', this.checked);
});

$("#show_prop").click(function() {
  var block = document.getElementById("bloco"); 
  block.classList.remove("d-none");
  block.classList.add("d-block");
  //RESETA O HTML
  $('#selec_prop').empty();

  //PEGA O VALOR DA RADIO
  $('#prop_table input:radio:checked').each(function() {
    var array = $(this).parent().siblings().map(function() {
      return $(this).text().trim();
    }).get();

  //PRINTA EM FORMA DE ARRAY
    $('#selec_prop').append(array.join("<br>"));
  })
});

</script>
<script>

$('#selectall').click(function(event) {
  $(':radio').prop('checked', this.checked);
});

$("#show_inq").click(function() {
  var block2 = document.getElementById("bloco2"); 
  block2.classList.remove("d-none");
  block2.classList.add("d-block");
  //RESETA O HTML
  $('#selec_inq').empty();

  //PEGA O VALOR DA RADIO
  $('#inq_table input:radio:checked').each(function() {
    var array = $(this).parent().siblings().map(function() {
      return $(this).text().trim();
    }).get();

  //PRINTA EM FORMA DE ARRAY
    $('#selec_inq').append(array.join("<br>"));
  })
});

</script>
</body>
</html>
