<?php require_once "../verify.php" ?>
<?php require_once "../conexao.php" ?>
<!doctype html>
<html lang="pt-br">

<head>
  <?php require_once "../head.php" ?>
  <style>
    body {
      font-size: 25px;
      print-color-adjust: exact;
      -webkit-print-color-adjust: exact;
    }

    td {
      word-wrap: break-word !important;
      border: 2px solid #666 !important;
    }

    th {
      border: 2px solid #666 !important;
    }

    @media print {
      .table-striped tbody tr:nth-of-type(odd) td {
        background-color: #F2F2F2 !important;
      }

      body * {
        visibility: hidden;
      }

      .d-print-none {
        display: none;
      }

      #print,
      #print * {
        visibility: visible;
      }
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row my-3 d-print-none">
      <div class="col-4">
        <a class="btn btn-lg btn-block btn-success" href="contatos.php"><i class="fas fa-chevron-left mr-2"></i>Voltar</a>
      </div>
      <div class="col-8">
        <a class="btn btn-lg btn-block btn-primary" onclick="print()" href=""><i class="fas fa-print mr-2"></i>Imprimir</a>
      </div>
    </div>
    <div id="print">
      <div class="row my-4">
        <div class="col-12">
          <img src="../dist/img/logo_log.png" class="img-fluid rounded mx-auto d-block">
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <table class="table table-striped text-center border">
            <thead>
              <tr>
                <th class="text-primary" scope="col">Proprietário</th>
                <th class="text-primary" scope="col" width="200">Celular</th>
                <th class="text-success" scope="col">Inquilino</th>
                <th class="text-success" scope="col" width="200">Celular</th>
              </tr>
            </thead>
            <?php

            $select_contatos = "SELECT c.* FROM contatos AS c JOIN proprietarios AS p ON p.id = c.id_prop ORDER BY p.nome";
            $exec_contatos = mysqli_query($conn, $select_contatos);
            $reg_contatos = mysqli_num_rows($exec_contatos);

            ?>
            <tbody>
              <?php while ($contatos = mysqli_fetch_assoc($exec_contatos)) :

                $id_contato = $contatos['id'];
                $id_prop = $contatos['id_prop'];
                $id_inq = $contatos['id_inq'];

                //BUSCANDO O PROP

                $select_prop = "SELECT * FROM proprietarios WHERE id='$id_prop'";
                $exec_prop = mysqli_query($conn, $select_prop);
                $info_prop = mysqli_fetch_assoc($exec_prop);
                $prop = $info_prop['nome'];
                $prop_cel = $info_prop['celular1'];

                //BUSCANDO O INQ

                $select_inq = "SELECT * FROM inquilinos WHERE id='$id_inq'";
                $exec_inq = mysqli_query($conn, $select_inq);
                $info_inq = mysqli_fetch_assoc($exec_inq);
                $inq = $info_inq['nome'];
                $inq_cel = $info_inq['celular'];


              ?>
                <tr>
                  <td><?= $prop ?></td>
                  <td><?= $prop_cel ?></td>
                  <td><?= $inq ?></td>
                  <td><?= $inq_cel ?></td>
                </tr>
              <?php endwhile ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Scripts -->
  <?php require_once "../scripts.php" ?>
  <!-- Scripts -->
</body>

</html>