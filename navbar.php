<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-cog"></i>
        </a>
        <div class="p-2 dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php 
          $nomeUser = "SELECT * FROM users WHERE id='{$_SESSION['id']}'";
          $execUser = mysqli_query($conn, $nomeUser);
          $dataUser = mysqli_fetch_assoc($execUser);
        ?>
        <span class="dropdown-header user-name">
          <?= $dataUser['nome'] ?>
        </span>

          <div class="d-flex flex-row align-items-center justify-content-center mt-1 mb-3">
            <?php
              if((isset($dataUser['foto']) AND !empty($dataUser['foto']))){
                $src = '../registros/'. $dataUser['id'] . '/' . $dataUser['foto'];
              }else{              
                $src = '../dist/img/avatar5.png';
              }
            ?>
            <img class='img-circle elevation-2 custom-navbar-user-img' src="<?= $src ?>">
          </div>
        
          <div class="dropdown-divider"></div>
            <div class="row">
              <div class="col-6">
              <a href="../painel/conta.php" class="btn btn-block btn-primary mt-2"><i class="fas fa-user-edit mr-2"></i>Conta</a> 
              </div>
              <div class="col-6">
              <a href="../user/logout.php" class="btn btn-block btn-danger mt-2">Sair<i class="fas fa-sign-out-alt ml-2"></i></a>
              </div>
            </div>

        </div>
        </div>
      </li>
    </ul>
</nav>