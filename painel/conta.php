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
            <h1 class="m-0 text-dark">Minha Conta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> <a href="">Painel</a> / Conta</li>
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
              <a style="border-radius: 30px;" class="btn btn-lg btn-primary" href="index.php"><i class="fas fa-chevron-left mr-2"></i>Painel</a>              
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex flex-row-reverse mt-3">
            <a href="" data-toggle="modal" data-target="#removerConta" class="btn btn-sm btn-danger"><i class="fas fa-user-times mr-2"></i>Deletar conta</a>             
            <a href="../user/cadastro.php" type="submit" class="btn btn-sm btn-success mr-2"><i class="fas fa-user-plus mr-2"></i>Novo usuário</a>             
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
            <?php 
                $select_user = "SELECT * FROM users WHERE id='{$_SESSION['id']}'";
                $exec_user = mysqli_query($conn, $select_user);
                $user_info = mysqli_fetch_assoc($exec_user);
            ?>
            <?php
              if((isset($user_info['foto']) AND !empty($user_info['foto']))){
                $src = '../registros/'. $user_info['id'] . '/' . $user_info['foto'];
              }else{              
                $src = '../dist/img/avatar5.png';
              }
            ?>
        <div class="col-12">
        <div class="card">
            <div class="card-body">
            <form action="editar-conta.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
            <div class="form-group col-12">
            <label>Foto de perfil</label>
            <img id="active-profile-pic" src="<?= $src ?>" class="img-fluid mb-3 profile-pic-active">
            <img id="preview" class="img-fluid mb-3 profile-pic-preview">
            <?php if((isset($user_info['foto']) AND !empty($user_info['foto']))): ?>
            <a href="remover-foto.php?id=<?= $user_info['id'] ?>" class="btn btn-default btn-sm mb-3">
              Remover foto
            </a>
            <?php endif;?> 
            <div class="custom-file" style="cursor: pointer !important;">          
            <input style="cursor: pointer !important;" type="file" name="img" id="imagem" onchange="previewImagem()" class="custom-file-input">
            <label style="cursor: pointer !important;" class="custom-file-label" for="validatedCustomFile">Escolher foto...</label>
            </div>
            </div>
            </div>
            <div class="form-row">
            <input type="hidden" name="id" value="<?= $user_info['id'] ?>">
            <div class="form-group col-12">
                <label>Alterar nome</label>
                <input type="text" name="nome" value="<?= $user_info['nome'] ?>" class="form-control">
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-6">
                <label>Alterar usuário</label>
                <input type="text" name="user" value="<?= $user_info['usuario'] ?>" class="form-control" >
            </div>           
            <div class="form-group col-6">
                <label>Alterar senha</label>
                <input data-toggle="modal" data-target="#password_change" type="password" class="form-control">
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-12">
            <div style="user-select: none;" class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="customSwitch1" required>
              <label class="custom-control-label font-weight-normal" for="customSwitch1">Confirmar alterações</label>
            </div>
            </div>           
            </div>           
            <button type="submit" class="btn btn-lg btn-success float-right">Salvar</button>
            </form>
            </div>
            </div>
        </div>
      </div>
      </div>

<!-- Modal Senha -->
<div class="modal fade" id="password_change" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-lock mr-2"></i>Alterar senha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body">
        <form action="editar-senha.php" method="POST">
        <input type="hidden" name="id2" value="<?= $user_info['id'] ?>">
          <div class="form-row">
            <div class="form-group col-12">
              <label>Nova senha</label>
              <div class="input-group" title="Ver senha">
                <input type="password" id="pass" class="form-control border-right-0" name="senha">
                <div class="input-group-append">
                  <button style="border-color: #CED4DA;" onclick="verSenha()" class="btn border-left-0" type="button"><i id="icon" class="fas fa-eye text-primary"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-12 mb-0">
            <div style="user-select: none;" class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="customSwitch2" required>
              <label class="custom-control-label font-weight-normal" for="customSwitch2">Confirmar alterações</label>
            </div>
            </div>           
          </div>        
      </div>
      <div style="background-color: #f7f7f7;" class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-success">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Apagar conta -->
<div class="modal fade" id="removerConta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-danger">
      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-times mr-2"></i>Deletar conta</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fas fa-times-circle text-white"></i>
      </button>
    </div>
    <div class="modal-body">
      <h5 class="mb-0">Deseja realmente deletar sua conta?</h5>
      <small class="form-text text-muted">Sua conta será permanentemente deletada e todos os dados serão perdidos.</small>
    </div>
    <div style="background-color: #f7f7f7" class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      <a href="delete-conta.php?id=<?= $user_info['id'] ?>" class="btn btn-danger">Deletar</a>
    </div>
  </div>
</div>
</div>
<!-- //Apagar conta -->

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
        function previewImagem(){
                var imagem = document.querySelector('input[name=img]').files[0];
                var preview = document.getElementById("preview");
                var active = document.getElementById("active-profile-pic");
                
                var reader = new FileReader();

                reader.onloadend = function(){
                    preview.src = reader.result;
                    preview.style.display = 'block';
                    active.style.display = 'none';
                } 

                if(imagem){
                    reader.readAsDataURL(imagem);                
                }else{
                    preview.src = "";
                }
            }
</script>

<script>
  function verSenha(){

    var tipo = document.getElementById("pass");
    var icon = document.getElementById("icon");

    if(tipo.type == "password"){
      tipo.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    }else{
      tipo.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }

  }
</script>

<!-- Data Mask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous"></script>
</body>
</html>
