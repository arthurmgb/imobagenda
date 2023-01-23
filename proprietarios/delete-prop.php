<?php

require_once "../conexao.php";
session_start();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$delete_prop = "DELETE FROM proprietarios WHERE id='$id'";
$exec_delete = mysqli_query($conn, $delete_prop);

if(mysqli_affected_rows($conn)){
    $_SESSION['msg'] = "<div id='remove' class='alert alert-success mb-2' role='alert'>
    Proprietário removido com sucesso!
    </div>";
    header("Location: proprietarios.php");
}else{
    $_SESSION['msg'] = "<div id='remove' class='alert alert-danger mb-2' role='alert'>
    Erro ao remover proprietário!
    </div>";
    header("Location: proprietarios.php");
}
