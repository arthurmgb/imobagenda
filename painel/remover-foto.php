<?php

session_start();
require_once "../conexao.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$update_usuario = "UPDATE users SET foto = '' WHERE id='$id'";
$exec_update = mysqli_query($conn, $update_usuario);

$_SESSION['msg'] = "<div id='remove' class='alert alert-success mb-0' role='alert'>
        Foto removida com sucesso.
        </div>";

array_map('unlink', glob("../registros/$id/*.*"));

header("Location: conta.php");